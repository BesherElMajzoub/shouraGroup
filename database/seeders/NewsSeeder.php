<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'cat_slug' => 'agencies',
                'title' => 'إضافة نوعية جديدة: وصول مضخات EMS PUMP التركية لأول مرة إلى صالاتنا',
                'slug' => 'ems-pump-arrival',
                'excerpt' => 'في إطار سعينا الدائم لتوسيع محفظة منتجاتنا وتلبية كافة الاحتياجات الهندسية بأسعار تنافسية وجودة عالية، تعلن مجموعة شورى إخوان عن توفير مضخات EMS PUMP التركية العريقة لأول مرة في السوق...',
                'body' => "يسر مجموعة شورى إخوان أن تزف لعملائها في القطاعين الصناعي والزراعي خبر وصول الدفعة الأولى من مضخات EMS PUMP التركية الرائدة إلى صالات العرض ومستودعاتنا.\n\nتأتي هذه الخطوة الاستراتيجية لتوفير حلول ضخ متنوعة وموثوقة تواكب متطلبات المشاريع الحديثة، وتتميز منتجات EMS بمتانتها وكفاءتها العالية في استهلاك الطاقة.\n\nندعوكم لزيارة فروعنا في دمشق وحلب للاطلاع على التشكيلة الجديدة والمواصفات الفنية، حيث يقف فريقنا الهندسي جاهزاً لتقديم الاستشارة واختيار المضخة الأنسب لمشاريعكم.",
                // TODO: استبدلها بصورة مضخات EMS أو صورة وصول البضاعة عند توفرها
                'image' => 'images/sectors/water-pumps.png',
                'published_at' => '2026-07-01 10:00:00',
                'is_published' => true,
                'order' => 1,
            ],
        ];

        $categories = Category::where('type', 'news')->pluck('id', 'slug');

        foreach ($news as $n) {
            $slug = $n['cat_slug'];
            unset($n['cat_slug']);
            $n['category_id'] = $categories[$slug];

            News::updateOrCreate(['slug' => $n['slug']], $n);
        }
    }
}
