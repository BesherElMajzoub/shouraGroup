#!/usr/bin/env bash
#
# Shora Group — export the local database for import through phpMyAdmin.
#
# Run from the project root in Git Bash:   bash deploy/export-db.sh
#
# Credentials are read from .env, never passed on the command line (they would
# be visible in the process list). Runtime tables — cache, sessions, queues —
# are exported as structure only; their local rows are meaningless on the
# server and sessions would carry over cookies signed with the old APP_KEY.

set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT"

env_value() {
    # Strip surrounding quotes and any trailing comment/whitespace.
    sed -n "s/^$1=//p" .env | head -1 | sed -e 's/^"\(.*\)"$/\1/' -e "s/^'\(.*\)'\$/\1/" -e 's/[[:space:]]*$//'
}

DB_HOST="$(env_value DB_HOST)"
DB_PORT="$(env_value DB_PORT)"
DB_NAME="$(env_value DB_DATABASE)"
DB_USER="$(env_value DB_USERNAME)"
DB_PASS="$(env_value DB_PASSWORD)"

OUT="$ROOT/deploy/shora-database.sql"
CNF="$(mktemp)"
trap 'rm -f "$CNF"' EXIT

cat > "$CNF" <<CNFEOF
[client]
host=${DB_HOST}
port=${DB_PORT}
user=${DB_USER}
password=${DB_PASS}
CNFEOF

# Tables whose rows are local-only state.
RUNTIME_TABLES=(cache cache_locks sessions jobs job_batches failed_jobs)

COMMON=(
    --defaults-extra-file="$CNF"
    --single-transaction
    --no-tablespaces
    --skip-lock-tables
    --default-character-set=utf8mb4
    --set-gtid-purged=OFF
    --column-statistics=0
)

echo "==> Exporting ${DB_NAME} -> ${OUT}"

{
    echo "-- Shora Group database export — $(date -u '+%Y-%m-%d %H:%M UTC')"
    echo "SET NAMES utf8mb4;"
    echo "SET FOREIGN_KEY_CHECKS = 0;"
    echo

    # Full schema + data, minus the runtime tables.
    IGNORES=()
    for t in "${RUNTIME_TABLES[@]}"; do
        IGNORES+=(--ignore-table="${DB_NAME}.${t}")
    done
    mysqldump "${COMMON[@]}" "${IGNORES[@]}" "$DB_NAME"

    echo
    echo "-- Runtime tables: structure only."
    mysqldump "${COMMON[@]}" --no-data "$DB_NAME" "${RUNTIME_TABLES[@]}"

    echo
    echo "SET FOREIGN_KEY_CHECKS = 1;"
} > "$OUT"

echo "==> Done"
echo "File : $OUT"
echo "Size : $(du -h "$OUT" | cut -f1)"
echo "Rows : $(grep -c '^INSERT INTO' "$OUT") INSERT statements"
echo
echo "Import it through phpMyAdmin into the database created on the server."
