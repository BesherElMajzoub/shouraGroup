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
                'cat_slug' => 'water',
                'title' => 'محطة تحلية مياه الشرب الكبرى',
                'client' => 'القطاع الخاص الخدمي',
                'location' => 'ريف دمشق، سوريا',
                'year' => '2025',
                'description' => 'تصميم وتوريد وتركيب محطة متكاملة لمعالجة وتحلية مياه الآبار بطاقة إنتاجية عالية لتغذية التجمعات السكانية بالمياه العذبة المطابقة للمواصفات.',
                'image' => 'images/industrial_bg.png',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'cat_slug' => 'pools',
                'title' => 'المجمع المائي الترفيهي الرياضي',
                'client' => 'شركة استثمار سياحي',
                'location' => 'اللاذقية، سوريا',
                'year' => '2024',
                'description' => 'تصميم وبناء مسبح أولمبي خارجي ومسبح مغلق للأطفال مجهزين بالكامل بأنظمة تسخين مياه شمسية متطورة وأنظمة تنقية رملية وصمامات ذكية.',
                'image' => 'images/about_skyscrapers.png',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'cat_slug' => 'contracting',
                'title' => 'برج شورى التجاري الإداري',
                'client' => 'مجموعة شورى للاستثمار',
                'location' => 'دمشق - أوتستراد المزة، سوريا',
                'year' => '2023',
                'description' => 'تنفيذ الهيكل الخرساني والإنشائي وعزل كامل الأسطح والجدران لبرج إداري حديث يتألف من 12 طابقاً وفق أحدث النظم الهندسية المقاومة للزلازل.',
                'image' => 'images/industrial_bg.png',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'cat_slug' => 'water',
                'title' => 'محطة معالجة مياه الصرف الصناعي',
                'client' => 'مصنع ألبان وأجبان رائد',
                'location' => 'حماة، سوريا',
                'year' => '2024',
                'description' => 'تصميم وبناء محطة مخصصة لمعالجة المياه الخارجة من العمليات الصناعية للحد من التلوث وإعادة تدوير المياه للاستخدام الزراعي واستصلاح الأراضي.',
                'image' => 'images/industrial_bg.png',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'cat_slug' => 'pools',
                'title' => 'تأهيل وتحديث مسبح نقابة المهندسين',
                'client' => 'نقابة المهندسين السوريين',
                'location' => 'حلب، سوريا',
                'year' => '2025',
                'description' => 'إعادة تأهيل وصيانة نظام التصفية الميكانيكي وعزل أرضيات وجدران المسبح المائي وتجهيزه بأنظمة تدفئة متكاملة لخدمة أعضاء النقابة طوال العام.',
                'image' => 'images/about_skyscrapers.png',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'cat_slug' => 'contracting',
                'title' => 'تجهيز شبكات المياه والصرف للمنطقة الصناعية',
                'client' => 'الجهات العامة المحلية',
                'location' => 'حمص، سوريا',
                'year' => '2022',
                'description' => 'حفر وتمديد وتجهيز خطوط شبكات مياه الشرب والصرف الصحي وقنوات تصريف مياه الأمطار للمنطقة الصناعية الحرفية الجديدة.',
                'image' => 'images/industrial_bg.png',
                'order' => 6,
                'is_active' => true,
            ]
        ];

        foreach ($projects as $p) {
            $category = Category::where('type', 'project')->where('slug', $p['cat_slug'])->first();
            if ($category) {
                Project::updateOrCreate(
                    ['title' => $p['title']],
                    [
                        'category_id' => $category->id,
                        'client' => $p['client'],
                        'location' => $p['location'],
                        'year' => $p['year'],
                        'description' => $p['description'],
                        'image' => $p['image'],
                        'order' => $p['order'],
                        'is_active' => $p['is_active'],
                    ]
                );
            }
        }
    }
}
