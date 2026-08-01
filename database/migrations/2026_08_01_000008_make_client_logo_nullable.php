<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Some clients are listed before their logo file is supplied; those render
     * as a text card, so the column has to accept null.
     */
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('logo')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('logo')->nullable(false)->change();
        });
    }
};
