<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Each sector routes its enquiries to its own inbox; when the column is
     * left empty the contact page falls back to the central contact email.
     */
    public function up(): void
    {
        Schema::table('sectors', function (Blueprint $table) {
            $table->string('email')->nullable()->after('slug');
        });
    }

    public function down(): void
    {
        Schema::table('sectors', fn (Blueprint $table) => $table->dropColumn('email'));
    }
};
