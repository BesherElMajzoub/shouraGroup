<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * map_top / map_left are percentage offsets of the pin over public/images/syria-map.svg.
     */
    public function run(): void
    {
        $branches = [
            [
                'name' => 'فرع دمشق – المرجة',
                'city' => 'دمشق',
                'address' => 'دمشق - المرجة',
                'description' => 'صالة عرض ومبيعات مفرق وجملة',
                'phone' => '011 2233743',
                'mobile' => '0932101176',
                'map_top' => 78,
                'map_left' => 9,
                'map_embed' => 'https://www.openstreetmap.org/export/embed.html?bbox=36.2915%2C33.5103%2C36.3031%2C33.5182&layer=mapnik&marker=33.5142%2C36.2973',
                'order' => 1,
            ],
            [
                'name' => 'فرع دمشق – البرامكة',
                'city' => 'دمشق',
                'address' => 'دمشق - البرامكة - زقاق الجن',
                'description' => 'صالة عرض متخصصة',
                // TODO: الرقم كما ورد في ملف الزبون (4 خانات) — يُرجى تأكيد الرقم الكامل
                'phone' => '011 9870',
                'mobile' => '0932101178',
                'map_top' => 71,
                'map_left' => 14,
                'map_embed' => 'https://www.openstreetmap.org/export/embed.html?bbox=36.2812%2C33.5051%2C36.2928%2C33.5130&layer=mapnik&marker=33.5090%2C36.2870',
                'order' => 2,
            ],
            [
                'name' => 'فرع حلب – باب النصر',
                'city' => 'حلب',
                'address' => 'حلب - باب النصر',
                'description' => 'فرع المنطقة الشمالية',
                'phone' => '021 2119914',
                'mobile' => null,
                'map_top' => 28,
                'map_left' => 28,
                'map_embed' => 'https://www.openstreetmap.org/export/embed.html?bbox=37.1522%2C36.1981%2C37.1638%2C36.2060&layer=mapnik&marker=36.2020%2C37.1580',
                'order' => 3,
            ],
        ];

        foreach ($branches as $b) {
            Branch::updateOrCreate(['name' => $b['name']], $b);
        }
    }
}
