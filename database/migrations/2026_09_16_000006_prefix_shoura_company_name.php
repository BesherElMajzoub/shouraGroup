<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'settings' => ['value'],
            'timeline_nodes' => ['title', 'description'],
            'stats' => ['label'],
            'services' => ['title', 'dept', 'description', 'features'],
            'clients' => ['name'],
            'categories' => ['name'],
            'projects' => [
                'title_ar', 'client_ar', 'location_ar', 'status_ar', 'summary_ar',
                'description_ar', 'challenge_ar', 'solution_ar', 'scope_ar',
                'equipment_ar', 'duration_ar', 'results_ar',
            ],
            'project_images' => ['caption_ar'],
            'news' => ['title_ar', 'excerpt_ar', 'body_ar'],
            'sectors' => ['name', 'tagline', 'intro', 'specialties'],
            'brands' => ['name', 'country', 'description'],
            'branches' => ['name', 'city', 'address', 'description'],
        ];

        foreach ($tables as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            $columns = array_values(array_filter(
                $columns,
                fn (string $column) => Schema::hasColumn($table, $column)
            ));

            if ($columns === [] || ! Schema::hasColumn($table, 'id')) {
                continue;
            }

            DB::table($table)
                ->select(array_merge(['id'], $columns))
                ->orderBy('id')
                ->chunkById(100, function ($rows) use ($table, $columns) {
                    foreach ($rows as $row) {
                        $updates = [];

                        foreach ($columns as $column) {
                            $value = $row->{$column};

                            if (! is_string($value) || ! str_contains($value, 'شورى')) {
                                continue;
                            }

                            $updated = preg_replace('/(?<!شركة )شورى/u', 'شركة شورى', $value);

                            if ($updated !== null && $updated !== $value) {
                                $updates[$column] = $updated;
                            }
                        }

                        if ($updates !== []) {
                            DB::table($table)->where('id', $row->id)->update($updates);
                        }
                    }
                });
        }
    }

    public function down(): void
    {
        // This wording update is intentionally irreversible because existing
        // occurrences of "شركة شورى" may predate this migration.
    }
};
