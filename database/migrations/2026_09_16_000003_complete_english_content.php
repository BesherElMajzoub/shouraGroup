<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('brands')
            ->where('slug', 'oswal')
            ->where(function ($query) {
                $query->whereNull('country_en')->orWhere('country_en', '');
            })
            ->update(['country_en' => 'India']);

        DB::table('settings')
            ->where('key', 'contact_whatsapp')
            ->where(function ($query) {
                $query->whereNull('value_en')->orWhere('value_en', '');
            })
            ->update(['value_en' => DB::raw('value')]);
    }

    public function down(): void
    {
        // Content backfills are intentionally not removed on rollback.
    }
};
