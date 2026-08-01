<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The client's spec shows two distinct service lists: five short "what we deliver"
     * cards on the home page, and four detailed service pillars on /services.
     * `group` keeps both editable from the same admin module.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('group')->default('pillar')->after('dept'); // home | pillar
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('group');
        });
    }
};
