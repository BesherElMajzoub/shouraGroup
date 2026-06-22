<?php

namespace Database\Seeders;

use App\Models\TimelineNode;
use Illuminate\Database\Seeder;

class TimelineNodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nodes = [
            ['event_date' => '2008', 'title' => 'انطلاقة شورى', 'description' => 'تأسيس شركة شورى للتجارة العامة كنواة لمجموعة طموحة، بفريق صغير ورؤية كبيرة لخدمة السوق السوري.', 'order' => 1],
            ['event_date' => '2011', 'title' => 'بناء الثقة الأولى', 'description' => 'توسيع قاعدة العملاء وترسيخ سمعة شورى في الالتزام والجودة ضمن نشاطها التجاري.', 'order' => 2],
            ['event_date' => '2013', 'title' => 'الدخول في قطاع المياه', 'description' => 'التوسّع نحو أنظمة معالجة وتحلية المياه ومستلزماتها، استجابةً لحاجة متنامية في السوق.', 'order' => 3],
            ['event_date' => '2016', 'title' => 'إطلاق قسمَي المسابح والمقاولات', 'description' => 'توسيع الأنشطة لتشمل تصميم وتنفيذ المسابح والمقاولات العامة بكوادر متخصصة.', 'order' => 4],
            ['event_date' => '2018', 'title' => 'تطوير قسم الصيانة والتشغيل', 'description' => 'إطلاق خدمات الصيانة الدورية والتشغيل لضمان استمرارية أداء الأنظمة والمحطات.', 'order' => 5],
            ['event_date' => '2020', 'title' => 'تأسيس مجموعة شورى', 'description' => 'تحويل الأقسام إلى شركات متخصصة تحت مظلة المجموعة، بهيكلية أكثر مرونة واحترافية.', 'order' => 6],
            ['event_date' => '2022', 'title' => 'شراكات وتوريدات عالمية', 'description' => 'توقيع اتفاقيات توريد مع علامات عالمية لتقديم أحدث المعدات والتقنيات لعملائنا.', 'order' => 7],
            ['event_date' => '2024', 'title' => 'حضور وطني أوسع', 'description' => 'افتتاح فروع جديدة لخدمة العملاء في المحافظات السورية، ومواصلة مسيرة النمو المستدام.', 'order' => 8],
        ];

        foreach ($nodes as $n) {
            TimelineNode::updateOrCreate(
                ['title' => $n['title']],
                $n
            );
        }
    }
}
