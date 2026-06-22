<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Project categories
            ['type' => 'project', 'name' => 'محطات وأنظمة المياه', 'slug' => 'water', 'order' => 1],
            ['type' => 'project', 'name' => 'المسابح والبحيرات', 'slug' => 'pools', 'order' => 2],
            ['type' => 'project', 'name' => 'المقاولات العامة والإنشاءات', 'slug' => 'contracting', 'order' => 3],

            // News categories
            ['type' => 'news', 'name' => 'أخبار المشاريع', 'slug' => 'projects', 'order' => 1],
            ['type' => 'news', 'name' => 'شراكات وتوريد', 'slug' => 'partnerships', 'order' => 2],
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
