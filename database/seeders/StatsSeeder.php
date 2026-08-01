<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stats = [
            ['value' => '+47', 'label' => 'عاماً من الخبرة', 'order' => 1, 'is_active' => true],
            ['value' => '+20', 'label' => 'وكالة وعلامة عالمية', 'order' => 2, 'is_active' => true],
            ['value' => '5', 'label' => 'قطاعات متخصصة', 'order' => 3, 'is_active' => true],
            ['value' => '3', 'label' => 'فروع وصالات عرض', 'order' => 4, 'is_active' => true],
            ['value' => '+1000', 'label' => 'عميل وشريك', 'order' => 5, 'is_active' => true],
            ['value' => '100%', 'label' => 'التزام بالجودة', 'order' => 6, 'is_active' => true],
        ];

        foreach ($stats as $s) {
            Stat::updateOrCreate(
                ['label' => $s['label']],
                $s
            );
        }
    }
}
