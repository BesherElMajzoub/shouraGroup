<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'cat_slug' => 'power-generation',
                'title' => 'دعم البنية التحتية والمخابز',
                'client' => 'منظمة أوكسفام (Oxfam)',
                'location' => 'سوريا',
                'year' => '2025',
                'description' => 'توريد وتركيب وتجهيز مجموعة توليد كهربائية باستطاعة 80 K.V.A لتشغيل إحدى منشآت المخابز، لضمان استمرارية العمل وتأمين طاقة موثوقة ومستدامة تلبي الاحتياجات الحيوية للمنشأة.',
                // TODO: استبدلها بصورة حقيقية من أرض الواقع عند توفرها
                'image' => 'images/sectors/generators.png',
                'order' => 1,
                'is_active' => true,
            ],
        ];

        $categories = Category::where('type', 'project')->pluck('id', 'slug');

        foreach ($projects as $p) {
            $slug = $p['cat_slug'];
            unset($p['cat_slug']);
            $p['category_id'] = $categories[$slug];

            Project::updateOrCreate(['title' => $p['title']], $p);
        }
    }
}
