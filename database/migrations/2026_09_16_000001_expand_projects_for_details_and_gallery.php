<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('title', 'title_ar');
            $table->renameColumn('client', 'client_ar');
            $table->renameColumn('location', 'location_ar');
            $table->renameColumn('description', 'description_ar');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('category_id');
            $table->string('title_en')->nullable()->after('title_ar');
            $table->string('client_en')->nullable()->after('client_ar');
            $table->string('location_en')->nullable()->after('location_ar');
            $table->string('status_ar')->nullable()->after('year');
            $table->string('status_en')->nullable()->after('status_ar');
            $table->text('summary_ar')->nullable()->after('status_en');
            $table->text('summary_en')->nullable()->after('summary_ar');
            $table->longText('description_en')->nullable()->after('description_ar');
            $table->longText('challenge_ar')->nullable()->after('description_en');
            $table->longText('challenge_en')->nullable()->after('challenge_ar');
            $table->longText('solution_ar')->nullable()->after('challenge_en');
            $table->longText('solution_en')->nullable()->after('solution_ar');
            $table->longText('scope_ar')->nullable()->after('solution_en');
            $table->longText('scope_en')->nullable()->after('scope_ar');
            $table->longText('equipment_ar')->nullable()->after('scope_en');
            $table->longText('equipment_en')->nullable()->after('equipment_ar');
            $table->string('duration_ar')->nullable()->after('equipment_en');
            $table->string('duration_en')->nullable()->after('duration_ar');
            $table->longText('results_ar')->nullable()->after('duration_en');
            $table->longText('results_en')->nullable()->after('results_ar');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('client_ar')->nullable()->change();
            $table->string('location_ar')->nullable()->change();
            $table->string('year')->nullable()->change();
        });

        foreach (DB::table('projects')->select('id', 'title_ar')->orderBy('id')->get() as $project) {
            $base = Str::slug($project->title_ar) ?: 'project-'.$project->id;
            $slug = $base;
            $suffix = 2;

            while (DB::table('projects')->where('slug', $slug)->exists()) {
                $slug = $base.'-'.$suffix++;
            }

            DB::table('projects')->where('id', $project->id)->update(['slug' => $slug]);
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->unique('slug');
        });

        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->text('caption_ar')->nullable();
            $table->text('caption_en')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();

            $table->index(['project_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_images');

        Schema::table('projects', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn([
                'slug', 'title_en', 'client_en', 'location_en', 'status_ar', 'status_en',
                'summary_ar', 'summary_en', 'description_en', 'challenge_ar', 'challenge_en',
                'solution_ar', 'solution_en', 'scope_ar', 'scope_en', 'equipment_ar',
                'equipment_en', 'duration_ar', 'duration_en', 'results_ar', 'results_en',
            ]);
        });

        DB::table('projects')->whereNull('client_ar')->update(['client_ar' => '']);
        DB::table('projects')->whereNull('location_ar')->update(['location_ar' => '']);
        DB::table('projects')->whereNull('year')->update(['year' => '']);

        Schema::table('projects', function (Blueprint $table) {
            $table->string('client_ar')->nullable(false)->change();
            $table->string('location_ar')->nullable(false)->change();
            $table->string('year')->nullable(false)->change();
            $table->renameColumn('title_ar', 'title');
            $table->renameColumn('client_ar', 'client');
            $table->renameColumn('location_ar', 'location');
            $table->renameColumn('description_ar', 'description');
        });
    }
};
