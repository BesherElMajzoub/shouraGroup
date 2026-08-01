<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            ['name' => 'Oxfam', 'logo' => 'images/clients/oxfam.png', 'order' => 1, 'is_active' => true],
            ['name' => 'UNRWA', 'logo' => 'images/clients/unrwa.jpg', 'order' => 2, 'is_active' => true],
            ['name' => 'الشركة السورية للبترول', 'logo' => 'images/clients/spc.png', 'order' => 3, 'is_active' => true],
            ['name' => 'الشركة السورية للاتصالات', 'logo' => 'images/clients/syriatel.jpg', 'order' => 4, 'is_active' => true],
            ['name' => 'الصندوق السيادي السوري', 'logo' => 'images/clients/sovereign-fund.png', 'order' => 5, 'is_active' => true],
            ['name' => 'المؤسسة السورية للمخابز', 'logo' => 'images/clients/bakeries.jpg', 'order' => 6, 'is_active' => true],
            ['name' => 'مؤسسة مياه درعا', 'logo' => 'images/clients/daraa-water.jpg', 'order' => 7, 'is_active' => true],
            // شعار غير متوفر بعد — يُعرض كبطاقة نصية حتى رفع الشعار من لوحة الإدارة
            ['name' => 'المؤسسة العامة للكهرباء', 'logo' => null, 'order' => 8, 'is_active' => true],
        ];

        foreach ($clients as $c) {
            Client::updateOrCreate(
                ['name' => $c['name']],
                $c
            );
        }
    }
}
