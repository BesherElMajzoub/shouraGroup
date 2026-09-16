<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sibling of the sector email column: visitors who prefer WhatsApp are sent
     * to the sector's own number, or to the central one when it is left empty.
     */
    public function up(): void
    {
        Schema::table('sectors', function (Blueprint $table) {
            $table->string('whatsapp', 30)->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('sectors', fn (Blueprint $table) => $table->dropColumn('whatsapp'));
    }
};
