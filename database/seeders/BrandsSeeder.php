<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Sector;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Brands with `logo => null` render as a text card until the logo file is
     * dropped into public/images/brands/ and the record updated from the admin panel.
     */
    public function run(): void
    {
        $brands = [
            // ===== شعارات الشركاء على الصفحة الرئيسية (بالترتيب المطلوب) =====
            [
                'name' => 'VMAN',
                'slug' => 'vman',
                'country' => 'الصين',
                'description' => 'محركات ديزل صناعية لمجموعات التوليد الكهربائي بمختلف الاستطاعات.',
                'logo' => 'images/brands/vman.png',
                'order' => 1,
                'sectors' => ['power-generation'],
            ],
            [
                'name' => 'FPT Industrial',
                'slug' => 'fpt',
                'country' => 'إيطاليا',
                'description' => 'محركات ديزل عالية الأداء لمجموعات التوليد والتطبيقات الصناعية.',
                'logo' => 'images/brands/fpt.png',
                'order' => 2,
                'sectors' => ['power-generation'],
            ],
            [
                'name' => 'Leroy Somer',
                'slug' => 'leroy-somer',
                'country' => 'فرنسا',
                'description' => 'مولدات ومحركات كهربائية (Alternators) لمجموعات التوليد.',
                'logo' => 'images/brands/leroy-somer.png',
                'order' => 3,
                'sectors' => ['power-generation'],
            ],
            [
                'name' => 'DeepSea Electronics',
                'slug' => 'deepsea',
                'country' => 'بريطانيا',
                'description' => 'لوحات التحكم والنقل الآلي (ATS) وأنظمة المراقبة لمجموعات التوليد.',
                'logo' => 'images/brands/deepsea.png',
                'order' => 4,
                'sectors' => ['power-generation'],
            ],
            [
                'name' => 'ESCO',
                'slug' => 'esco',
                'country' => 'لبنان',
                'description' => 'حلول التوليد الكهربائي وأنظمة الطاقة، شاملة تجميع المولدات بمختلف الاستطاعات، الكبائن العازلة للصوت، ولوحات التحكم (ATS).',
                'logo' => 'images/brands/esco.jpg',
                'is_agency' => true,
                'order' => 5,
                'sectors' => ['power-generation'],
            ],
            [
                'name' => 'FORAS',
                'slug' => 'foras',
                'country' => 'إيطاليا',
                'description' => 'تكنولوجيا مضخات المياه المتقدمة وحلول الضخ المتكاملة للمشاريع الزراعية، الصناعية، والتجارية.',
                'logo' => 'images/brands/foras.png',
                'is_agency' => true,
                'order' => 6,
                'sectors' => ['water-pumps'],
            ],
            [
                'name' => 'STREAM',
                'slug' => 'stream',
                'country' => 'الصين',
                'description' => 'حلول الضخ الذكية والاعتمادية الاقتصادية التي تغطي شريحة واسعة من الاستخدامات المنزلية والصناعية.',
                'logo' => 'images/brands/stream.png',
                'is_agency' => true,
                'order' => 7,
                'sectors' => ['water-pumps'],
            ],
            [
                'name' => 'BBC',
                'slug' => 'bbc',
                'country' => null,
                'description' => 'قواطع وكنتكتورات وتجهيزات كهربائية صناعية.',
                'logo' => null,
                'order' => 8,
                'sectors' => ['industrial-tools'],
            ],
            [
                'name' => 'PANELLI',
                'slug' => 'panelli',
                'country' => 'إيطاليا',
                'description' => 'مضخات غاطسة (غطاسات) للآبار العميقة بمواصفات إيطالية.',
                'logo' => null,
                'order' => 9,
                'sectors' => ['water-pumps'],
            ],
            [
                'name' => 'MMB',
                'slug' => 'mmb',
                'country' => 'ألمانيا',
                'description' => 'مضخات مياه للاستخدامات الشاقة وضواغط الهواء.',
                'logo' => 'images/brands/mmb.png',
                'is_agency' => true,
                'order' => 10,
                'sectors' => ['water-pumps', 'air-compressors'],
            ],
            [
                'name' => 'MARK',
                'slug' => 'mark',
                'country' => 'إيطاليا',
                'description' => 'تكنولوجيا الهواء المضغوط والضواغط الحلزونية (Screw Compressors) لضمان استمرارية وكفاءة خطوط الإنتاج والمصانع.',
                'logo' => 'images/brands/mark.jpg',
                'is_agency' => true,
                'order' => 11,
                'sectors' => ['air-compressors'],
            ],
            [
                'name' => 'ABAC',
                'slug' => 'abac',
                'country' => 'إيطاليا',
                'description' => 'ضواغط هواء ترددية وحلزونية للورش وخطوط الإنتاج.',
                'logo' => 'images/brands/abac.jpg',
                'order' => 12,
                'sectors' => ['air-compressors'],
            ],
            [
                'name' => 'BALMA',
                'slug' => 'balma',
                'country' => 'إيطاليا',
                'description' => 'ضواغط هواء صناعية موثوقة للتشغيل المستمر.',
                'logo' => 'images/brands/balma.jpeg',
                'order' => 13,
                'sectors' => ['air-compressors'],
            ],
            [
                'name' => 'HYUNDAI',
                'slug' => 'hyundai',
                'country' => 'كوريا الجنوبية',
                'description' => 'معدات الطاقة والتوليد الكهربائي.',
                'logo' => 'images/brands/hyundai.webp',
                'order' => 14,
                'sectors' => ['power-generation'],
            ],
            [
                'name' => 'KEYANG',
                'slug' => 'keyang',
                'country' => 'كوريا الجنوبية',
                'description' => 'العدد والأدوات الكهربائية الاحترافية للورش والمقاولين.',
                'logo' => null,
                'order' => 15,
                'sectors' => ['industrial-tools'],
            ],

            // ===== علامات إضافية (تظهر في صفحات القطاعات وصفحة العلامات) =====
            [
                'name' => 'PENTAX',
                'slug' => 'pentax',
                'country' => 'إيطاليا',
                'description' => 'منظومات نقل المياه الشاملة، وتشمل المضخات السطحية والغاطسة المصممة لتحمل ظروف التشغيل القاسية وطويلة الأمد.',
                'logo' => null,
                'is_agency' => true,
                'show_on_home' => false,
                'order' => 16,
                'sectors' => ['water-pumps'],
            ],
            [
                'name' => 'DAB Water Technology',
                'slug' => 'dab',
                'country' => 'إيطاليا',
                'description' => 'تكنولوجيا مضخات المياه للاستخدامات المنزلية والتجارية.',
                'logo' => null,
                'show_on_home' => false,
                'order' => 17,
                'sectors' => ['water-pumps'],
            ],
            [
                'name' => 'C.R.I. PUMPS',
                'slug' => 'cri',
                'country' => 'عالمية',
                'description' => 'مضخات مياه صناعية وزراعية بتشكيلة واسعة من الاستطاعات.',
                'logo' => 'images/brands/cri.jpg',
                'show_on_home' => false,
                'order' => 18,
                'sectors' => ['water-pumps'],
            ],
            [
                'name' => 'OSWAL Pumps & Motors',
                'slug' => 'oswal',
                'country' => 'الهند',
                'description' => 'مضخات ومحركات كهربائية للتطبيقات الزراعية والصناعية.',
                'logo' => 'images/brands/oswal.jpg',
                'show_on_home' => false,
                'order' => 19,
                'sectors' => ['water-pumps'],
            ],
            [
                'name' => 'ALUP Kompressoren',
                'slug' => 'alup',
                'country' => 'ألمانيا',
                'description' => 'ضواغط هواء حلزونية للتشغيل المستمر وأنظمة الهواء الطبي.',
                'logo' => 'images/brands/alup.jpg',
                'show_on_home' => false,
                'order' => 20,
                'sectors' => ['air-compressors', 'medical-gases'],
            ],
            [
                'name' => 'Worthington Creyssensac',
                'slug' => 'worthington',
                'country' => 'إيطاليا',
                'description' => 'ضواغط هواء صناعية ومنظومات الهواء المضغوط والطبي.',
                'logo' => null,
                'show_on_home' => false,
                'order' => 21,
                'sectors' => ['air-compressors', 'medical-gases'],
            ],
            [
                'name' => 'OMEGA AIR',
                'slug' => 'omega-air',
                'country' => 'سلوفينيا',
                'description' => 'أنظمة معالجة الهواء المضغوط: مجففات وفلاتر ووحدات تنقية.',
                'logo' => 'images/brands/omega-air.png',
                'show_on_home' => false,
                'order' => 22,
                'sectors' => ['air-compressors'],
            ],
            [
                'name' => 'SOTRAS',
                'slug' => 'sotras',
                'country' => 'إيطاليا',
                'description' => 'فلاتر ومتممات أصلية لضواغط الهواء ومجموعات التوليد.',
                'logo' => 'images/brands/sotras.png',
                'show_on_home' => false,
                'order' => 23,
                'sectors' => ['air-compressors'],
            ],
            [
                'name' => 'SICC',
                'slug' => 'sicc',
                'country' => 'إيطاليا',
                'description' => 'خزانات الهواء المضغوط بمختلف السعات وضغوط التشغيل.',
                'logo' => null,
                'show_on_home' => false,
                'order' => 24,
                'sectors' => ['air-compressors'],
            ],
            [
                'name' => 'AERZEN',
                'slug' => 'aerzen',
                'country' => 'ألمانيا',
                'description' => 'نافخات ومضخات تفريغ (Blowers) للتطبيقات الصناعية ومعالجة المياه.',
                'logo' => 'images/brands/aerzen.jpg',
                'show_on_home' => false,
                'order' => 25,
                'sectors' => ['air-compressors'],
            ],
            [
                'name' => 'INMATEC GasTechnologie',
                'slug' => 'inmatec',
                'country' => 'ألمانيا',
                'description' => 'تكنولوجيا الغازات ومحطات توليد الأوكسجين والنيتروجين الطبي والصناعي.',
                'logo' => 'images/brands/inmatec.png',
                'show_on_home' => false,
                'order' => 26,
                'sectors' => ['medical-gases'],
            ],
            [
                'name' => 'EMS PUMP',
                'slug' => 'ems-pump',
                'country' => 'تركيا',
                'description' => 'مضخات مياه تركية عريقة تتميز بمتانتها وكفاءتها العالية في استهلاك الطاقة.',
                'logo' => null,
                'show_on_home' => false,
                'order' => 27,
                'sectors' => ['water-pumps'],
            ],
        ];

        $sectorIds = Sector::pluck('id', 'slug');

        foreach ($brands as $b) {
            $sectorSlugs = $b['sectors'] ?? [];
            unset($b['sectors']);

            $brand = Brand::updateOrCreate(['slug' => $b['slug']], $b);
            $brand->sectors()->sync($sectorIds->only($sectorSlugs)->values()->all());
        }
    }
}
