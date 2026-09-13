<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->renameColumn('title', 'title_ar');
            $table->renameColumn('excerpt', 'excerpt_ar');
            $table->renameColumn('body', 'body_ar');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title_ar');
            $table->text('excerpt_en')->nullable()->after('excerpt_ar');
            $table->longText('body_en')->nullable()->after('body_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'excerpt_en', 'body_en']);
        });

        Schema::table('news', function (Blueprint $table) {
            $table->renameColumn('title_ar', 'title');
            $table->renameColumn('excerpt_ar', 'excerpt');
            $table->renameColumn('body_ar', 'body');
        });
    }
};
