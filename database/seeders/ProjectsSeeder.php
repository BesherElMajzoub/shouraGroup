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
                'slug' => 'bakery-infrastructure-support',
                'title_ar' => 'دعم البنية التحتية والمخابز',
                'title_en' => 'Bakery Infrastructure Support',
                'client_ar' => 'منظمة أوكسفام (Oxfam)',
                'client_en' => 'Oxfam',
                'location_ar' => 'سوريا',
                'location_en' => 'Syria',
                'year' => '2025',
                'status_ar' => 'مكتمل',
                'status_en' => 'Completed',
                'summary_ar' => 'حل طاقة موثوق يضمن استمرارية تشغيل إحدى منشآت المخابز الحيوية.',
                'summary_en' => 'A reliable power solution that keeps a vital bakery facility operating continuously.',
                'description_ar' => 'توريد وتركيب وتجهيز مجموعة توليد كهربائية باستطاعة 80 K.V.A لتشغيل إحدى منشآت المخابز، لضمان استمرارية العمل وتأمين طاقة موثوقة ومستدامة تلبي الاحتياجات الحيوية للمنشأة.',
                'description_en' => 'Supply, installation, and commissioning of an 80 KVA generator set for a bakery facility, ensuring operational continuity through reliable and sustainable power.',
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

            Project::updateOrCreate(['slug' => $p['slug']], $p);
        }
    }
}
