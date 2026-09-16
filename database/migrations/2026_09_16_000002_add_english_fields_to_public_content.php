<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', fn (Blueprint $table) => $table->text('value_en')->nullable());
        Schema::table('timeline_nodes', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->text('description_en')->nullable();
        });
        Schema::table('stats', fn (Blueprint $table) => $table->string('label_en')->nullable());
        Schema::table('services', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->string('dept_en')->nullable();
            $table->text('description_en')->nullable();
            $table->json('features_en')->nullable();
        });
        Schema::table('sectors', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('tagline_en')->nullable();
            $table->text('intro_en')->nullable();
            $table->json('specialties_en')->nullable();
        });
        Schema::table('brands', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('country_en')->nullable();
            $table->text('description_en')->nullable();
        });
        Schema::table('branches', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('city_en')->nullable();
            $table->string('address_en')->nullable();
            $table->string('description_en')->nullable();
        });
        Schema::table('clients', fn (Blueprint $table) => $table->string('name_en')->nullable());
        Schema::table('categories', fn (Blueprint $table) => $table->string('name_en')->nullable());

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
            $english = data_get($content, 'settings.'.$row->key) ?: $translate($row->value);
            if ($english !== null) {
                DB::table('settings')->where('id', $row->id)->update(['value_en' => $english]);
            }
        });

        DB::table('services')->orderBy('id')->each(function ($row) use ($content, $translate, $translateJson) {
            $base = "services.{$row->group}.{$row->order}";
            DB::table('services')->where('id', $row->id)->update(array_filter([
                'title_en' => data_get($content, $base.'.title') ?: $translate($row->title),
                'dept_en' => data_get($content, $base.'.dept') ?: $translate($row->dept),
                'description_en' => data_get($content, $base.'.description') ?: $translate($row->description),
                'features_en' => $translateJson($row->features),
            ], fn ($value) => $value !== null));
        });

        $tables = [
            'timeline_nodes' => ['title', 'description'],
            'stats' => ['label'],
            'sectors' => ['name', 'tagline', 'intro'],
            'brands' => ['name', 'country', 'description'],
            'branches' => ['name', 'city', 'address', 'description'],
            'clients' => ['name'],
            'categories' => ['name'],
        ];

        foreach ($tables as $table => $fields) {
            DB::table($table)->orderBy('id')->each(function ($row) use ($table, $fields, $translate) {
                $updates = [];
                foreach ($fields as $field) {
                    $translated = $translate($row->{$field});
                    if ($translated !== null) {
                        $updates[$field.'_en'] = $translated;
                    }
                }
                if ($updates !== []) {
                    DB::table($table)->where('id', $row->id)->update($updates);
                }
            });
        }

        DB::table('sectors')->orderBy('id')->each(function ($row) use ($translateJson) {
            if ($translated = $translateJson($row->specialties)) {
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

    public function down(): void
    {
        Schema::table('categories', fn (Blueprint $table) => $table->dropColumn('name_en'));
        Schema::table('clients', fn (Blueprint $table) => $table->dropColumn('name_en'));
        Schema::table('branches', fn (Blueprint $table) => $table->dropColumn(['name_en', 'city_en', 'address_en', 'description_en']));
        Schema::table('brands', fn (Blueprint $table) => $table->dropColumn(['name_en', 'country_en', 'description_en']));
        Schema::table('sectors', fn (Blueprint $table) => $table->dropColumn(['name_en', 'tagline_en', 'intro_en', 'specialties_en']));
        Schema::table('services', fn (Blueprint $table) => $table->dropColumn(['title_en', 'dept_en', 'description_en', 'features_en']));
        Schema::table('stats', fn (Blueprint $table) => $table->dropColumn('label_en'));
        Schema::table('timeline_nodes', fn (Blueprint $table) => $table->dropColumn(['title_en', 'description_en']));
        Schema::table('settings', fn (Blueprint $table) => $table->dropColumn('value_en'));
    }
};
