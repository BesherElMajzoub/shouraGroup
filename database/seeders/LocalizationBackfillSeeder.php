<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalizationBackfillSeeder extends Seeder
{
    public function run(): void
    {
        $phrases = require lang_path('en/site.php');
        $content = require lang_path('en/content.php');

        $translate = static function ($value) use ($phrases) {
            if (! is_string($value) || $value === '') {
                return null;
            }
            $translated = strtr($value, $phrases);

            return preg_match('/[\x{0600}-\x{06FF}]/u', $translated) === 1 ? null : $translated;
        };
        $translateJson = static function ($value) use ($translate) {
            $items = is_string($value) ? json_decode($value, true) : $value;
            if (! is_array($items)) {
                return null;
            }
            $translated = array_map($translate, $items);

            return in_array(null, $translated, true) ? null : json_encode($translated, JSON_UNESCAPED_UNICODE);
        };

        DB::table('settings')->orderBy('id')->each(function ($row) use ($content, $translate) {
            if (blank($row->value_en)) {
                DB::table('settings')->where('id', $row->id)->update([
                    'value_en' => data_get($content, 'settings.'.$row->key) ?: $translate($row->value),
                ]);
            }
        });

        DB::table('services')->orderBy('id')->each(function ($row) use ($content, $translate, $translateJson) {
            $base = "services.{$row->group}.{$row->order}";
            $translations = [
                'title_en' => data_get($content, $base.'.title') ?: $translate($row->title),
                'dept_en' => data_get($content, $base.'.dept') ?: $translate($row->dept),
                'description_en' => data_get($content, $base.'.description') ?: $translate($row->description),
                'features_en' => $translateJson($row->features),
            ];
            $updates = array_filter($translations, fn ($value, $column) => blank($row->{$column}) && $value !== null, ARRAY_FILTER_USE_BOTH);
            if ($updates !== []) {
                DB::table('services')->where('id', $row->id)->update($updates);
            }
        });

        foreach ([
            'timeline_nodes' => ['title', 'description'],
            'stats' => ['label'],
            'sectors' => ['name', 'tagline', 'intro'],
            'brands' => ['name', 'country', 'description'],
            'branches' => ['name', 'city', 'address', 'description'],
            'clients' => ['name'],
            'categories' => ['name'],
        ] as $table => $fields) {
            DB::table($table)->orderBy('id')->each(function ($row) use ($table, $fields, $translate) {
                $updates = [];
                foreach ($fields as $field) {
                    if (blank($row->{$field.'_en'})) {
                        $updates[$field.'_en'] = $translate($row->{$field});
                    }
                }
                $updates = array_filter($updates, fn ($value) => $value !== null);
                if ($updates !== []) {
                    DB::table($table)->where('id', $row->id)->update($updates);
                }
            });
        }

        DB::table('sectors')->orderBy('id')->each(function ($row) use ($translateJson) {
            if (blank($row->specialties_en) && ($translated = $translateJson($row->specialties))) {
                DB::table('sectors')->where('id', $row->id)->update(['specialties_en' => $translated]);
            }
        });

        foreach ([
            'news' => ['title', 'excerpt', 'body'],
            'projects' => ['title', 'client', 'location', 'status', 'summary', 'description', 'challenge', 'solution', 'scope', 'equipment', 'duration', 'results'],
            'project_images' => ['caption'],
        ] as $table => $fields) {
            DB::table($table)->orderBy('id')->each(function ($row) use ($table, $fields, $translate) {
                $updates = [];
                foreach ($fields as $field) {
                    $englishColumn = $field.'_en';
                    $arabicColumn = $field.'_ar';
                    if (blank($row->{$englishColumn} ?? null) && ($translated = $translate($row->{$arabicColumn} ?? null))) {
                        $updates[$englishColumn] = $translated;
                    }
                }
                if ($updates !== []) {
                    DB::table($table)->where('id', $row->id)->update($updates);
                }
            });
        }
    }
}
