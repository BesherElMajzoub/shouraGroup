#!/usr/bin/env bash
#
# Shora Group — build an FTP-ready release folder.
#
# Run from the project root in Git Bash:   bash deploy/build-release.sh
#
# Produces ./release/ — upload its CONTENTS (not the folder itself) to the
# server's web root. Dev dependencies are stripped for the build and restored
# afterwards, so the local working copy is left exactly as it was found.

set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
OUT="$ROOT/release"

cd "$ROOT"

echo "==> 1/5  Building front-end assets"
npm run build

echo "==> 2/5  Installing production dependencies (no dev packages)"
composer install --no-dev --optimize-autoloader --no-interaction

echo "==> 3/5  Assembling $OUT"
rm -rf "$OUT"
mkdir -p "$OUT"

# Everything the application needs at runtime. resources/ is included because
# Blade views are compiled on demand from there. storage/ is listed by
# subdirectory rather than wholesale so that scratch files dropped at its root
# (audit dumps, exports) never reach the server.
tar --create --file=- \
    --exclude='./public/storage' \
    --exclude='./public/build.zip' \
    --exclude='./public/Website' \
    --exclude='./storage/logs/*.log' \
    --exclude='./storage/framework/cache/data/*' \
    --exclude='./storage/framework/views/*' \
    --exclude='./storage/framework/sessions/*' \
    --exclude='./storage/framework/testing/*' \
    --exclude='./storage/pail' \
    ./app ./bootstrap ./config ./database ./lang ./public ./resources ./routes ./vendor     ./storage/app ./storage/framework ./storage/logs \
    ./artisan ./composer.json ./composer.lock ./.htaccess \
  | tar --extract --file=- --directory="$OUT"

# The production environment file, for the operator to fill in on the server.
cp .env.production.example "$OUT/.env"

# The setup runner has to live under public/ so the root .htaccess can route to it.
cp deploy/deploy-setup.php "$OUT/public/deploy-setup.php"

# bootstrap/cache must ship empty — a cached config from this machine would
# point the live site at the local database.
rm -f "$OUT/bootstrap/cache/"*.php

echo "==> 4/5  Restoring dev dependencies for local work"
composer install --no-interaction

echo "==> 5/5  Done"
echo
echo "Release  : $OUT"
echo "Size     : $(du -sh "$OUT" | cut -f1)"
echo "Files    : $(find "$OUT" -type f | wc -l)"
echo
echo "Upload the CONTENTS of release/ to the web root, then read deploy/DEPLOY.md."
