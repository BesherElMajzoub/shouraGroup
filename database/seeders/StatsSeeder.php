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
            ['value' => '+45', 'label' => 'عاماً من الخبرة', 'order' => 1, 'is_active' => true],
            ['value' => '15+', 'label' => 'شراكة عالمية', 'order' => 2, 'is_active' => true],
            ['value' => '+5', 'label' => 'أقسام متخصصة', 'order' => 3, 'is_active' => true],
            ['value' => '+15', 'label' => 'سنة خبرة', 'order' => 4, 'is_active' => true],
            ['value' => '+50', 'label' => 'مشروع منجز', 'order' => 5, 'is_active' => true],
            ['value' => '+1000', 'label' => 'عميل سعيد', 'order' => 6, 'is_active' => true],
            ['value' => '100%', 'label' => 'نسبة رضا عملائنا', 'order' => 7, 'is_active' => true],
            ['value' => '+10M', 'label' => 'لتر مياه معالج يومياً', 'order' => 8, 'is_active' => true],
        ];

        foreach ($stats as $s) {
            Stat::updateOrCreate(
                ['label' => $s['label']],
                $s
            );
        }
    }
}
