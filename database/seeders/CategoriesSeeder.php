<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Project categories mirror the five business sectors so a project can be
     * filed under the sector that delivered it.
     */
    public function run(): void
    {
        $categories = [
            // Project categories — تطابق القطاعات
            ['type' => 'project', 'name' => 'مجموعات التوليد والطاقة', 'slug' => 'power-generation', 'order' => 1],
            ['type' => 'project', 'name' => 'مضخات المياه وحلول الضخ', 'slug' => 'water-pumps', 'order' => 2],
            ['type' => 'project', 'name' => 'ضواغط الهواء والغازات الصناعية', 'slug' => 'air-compressors', 'order' => 3],
            ['type' => 'project', 'name' => 'تجهيزات المشافي والغازات الطبية', 'slug' => 'medical-gases', 'order' => 4],
            ['type' => 'project', 'name' => 'المعدات والعدد الصناعية', 'slug' => 'industrial-tools', 'order' => 5],

            // News categories
            ['type' => 'news', 'name' => 'أخبار الوكالات والمنتجات', 'slug' => 'agencies', 'order' => 1],
            ['type' => 'news', 'name' => 'أخبار المشاريع', 'slug' => 'projects', 'order' => 2],
            ['type' => 'news', 'name' => 'إنجازات وفعاليات', 'slug' => 'achievements', 'order' => 3],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['type' => $cat['type'], 'slug' => $cat['slug']],
                $cat
            );
        }
    }
}
