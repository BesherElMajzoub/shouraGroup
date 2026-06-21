@extends('layouts.app')

@section('title', 'المنتجات | مجموعة شورى')
@section('description', 'تصفح قائمة منتجات مجموعة شورى المتكاملة من محطات تحلية المياه، مضخات المياه، فلاتر المسابح، مواد التعقيم الكيميائية والمستلزمات الهندسية في سوريا.')

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    <section class="relative overflow-hidden bg-white border-b border-gray-100">
        <div class="absolute top-0 inset-x-0 h-1 bg-brand"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.04]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:100px;"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 py-10 lg:py-14">
            <nav class="text-sm text-[#888] mb-4 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-brand transition-colors">الرئيسية</a>
                <svg class="w-3.5 h-3.5 text-[#ccc] rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#141414] font-medium">المنتجات</span>
            </nav>
            <span class="inline-block text-brand font-bold text-xs tracking-widest uppercase mb-3">تجهيزات ومعدات أصلية ومكفولة</span>
            <h1 class="text-3xl sm:text-4xl font-black text-[#141414] mb-3">منتجاتنا</h1>
            <p class="max-w-xl text-[#555] leading-loose text-[15px]">
                نوفر لعملائنا في سوريا تشكيلة واسعة من أفضل الأنظمة والتجهيزات المائية ومعدات المسابح والمواد الكيميائية المستوردة من أرقى العلامات التجارية العالمية.
            </p>
        </div>
    </section>

    {{-- ===== PRODUCTS CATALOG SECTION ===== --}}
    @php
        $categories = [
            ['id' => 'all', 'label' => 'كل المنتجات'],
            ['id' => 'water', 'label' => 'أنظمة المياه والمعالجة'],
            ['id' => 'pools', 'label' => 'تجهيزات ومستلزمات المسابح'],
            ['id' => 'pumps', 'label' => 'المضخات والفلاتر'],
            ['id' => 'chemicals', 'label' => 'المواد الكيميائية والتعقيم'],
        ];

        $products = [
            [
                'cat' => 'water',
                'name' => 'محطة تحلية مياه منزلية ذكية RO',
                'desc' => 'نظام فلترة ومعالجة مياه متطور من 7 مراحل يعتمد على تقنية التناضح العكسي لإزالة كافة الأملاح والكلور والشوائب وتوفير مياه شرب صحية.',
                'brand' => 'Shora Water Pure',
                'specs' => ['الإنتاجية: 75 جالون يومياً', 'عدد المراحل: 7 مراحل متطورة', 'الكهرباء: 220 فولت / 50 هرتز', 'الضمان: سنتان حقيقيتان'],
                'img' => 'industrial_bg.png'
            ],
            [
                'cat' => 'pumps',
                'name' => 'مضخة مياه طاردة مركزية صناعية',
                'desc' => 'مضخة مياه ثقيلة ومقاومة لدرجات الحرارة العالية، مصممة خصيصاً للمشاريع الزراعية ومحطات المعالجة والمباني السكنية العالية لضمان تدفق قوي ومستقر.',
                'brand' => 'Pedrollo (إيطالي)',
                'specs' => ['القدرة: 5.5 حصان', 'أقصى تدفق: 1200 لتر/دقيقة', 'مادة المروحة: ستانلس ستيل 304', 'حماية حرارية داخلية مدمجة'],
                'img' => 'industrial_bg.png'
            ],
            [
                'cat' => 'pools',
                'name' => 'فلتر رملي عملاق للمسابح العامة والخاصة',
                'desc' => 'فلتر رملي مصنوع من الفايبر جلاس المقوى والمقاوم للأشعة فوق البنفسجية والمواد الكيميائية، مجهز بصمام سداسي لتسهيل عملية الغسيل العكسي والصيانة.',
                'brand' => 'AstralPool (إسباني)',
                'specs' => ['القطر البصري: 900 ملم', 'معدل الفلترة: 30 متر مكعب/ساعة', 'أقصى ضغط تشغيلي: 2.5 بار', 'مجهز بمقياس ضغط وصمام أمان'],
                'img' => 'about_skyscrapers.png'
            ],
            [
                'cat' => 'water',
                'name' => 'جهاز تعقيم المياه بالأشعة فوق البنفسجية (UV)',
                'desc' => 'نظام صديق للبيئة لتعقيم مياه الشرب والمسابح من البكتيريا والفيروسات دون تغيير طعم المياه أو رائحتها ودون استخدام أي إضافات كيميائية.',
                'brand' => 'Sterilight (كندي)',
                'specs' => ['معدل التدفق: 45 لتر/دقيقة', 'مادة الهيكل: ستانلس ستيل 316L', 'عمر اللمبة الافتراضي: 9000 ساعة', 'مزود بنظام إنذار لتعطل اللمبة'],
                'img' => 'industrial_bg.png'
            ],
            [
                'cat' => 'chemicals',
                'name' => 'كلور مسابح حبيبات عالي التركيز 90%',
                'desc' => 'كلور حبيبات سريع الذوبان ذو تركيز عالٍ جداً للقضاء على الطحالب والبكتيريا في المسابح وضمان بقاء المياه نقية وصالحة للسباحة الآمنة.',
                'brand' => 'Shora Chem',
                'specs' => ['التركيز: 90% كلور فعال', 'التعبئة: عبوة بلاستيكية 45 كغ', 'الذوبان: سريع وبدون رواسب بيضاء', 'مطابق للمواصفات القياسية السورية'],
                'img' => 'about_skyscrapers.png'
            ],
            [
                'cat' => 'pools',
                'name' => 'كشاف مسبح مائي ذكي LED RGB',
                'desc' => 'إضاءة غاطسة للمسابح بنظام LED RGB موفر للطاقة، يتيح التحكم باللون ودرجة السطوع مع عزل مائي كامل وحماية تامة ضد التماس الكهربائي.',
                'brand' => 'Shora Light',
                'specs' => ['القدرة: 18 واط - 12 فولت AC', 'الوقاية المائية: IP68 عزل تام', 'الألوان: متعدد الألوان RGB (16 لوناً)', 'العمر التشغيلي: 50,000 ساعة'],
                'img' => 'about_skyscrapers.png'
            ],
        ];
    @endphp

    @php
        $counts = collect($products)->countBy('cat');
    @endphp
    <section class="py-16 lg:py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 grid lg:grid-cols-[280px_1fr] gap-8 lg:gap-10 items-start">

            {{-- ===== SIDEBAR: categories filter (right in RTL) ===== --}}
            <aside class="lg:sticky lg:top-28">
                <div class="bg-[#f7f7f8] rounded-2xl p-5 ring-1 ring-black/5">
                    {{-- search --}}
                    <div class="relative mb-5">
                        <input type="text" id="searchInput" onkeyup="searchProducts()" placeholder="ابحث عن منتج..."
                               class="w-full bg-white rounded-xl px-4 py-2.5 pr-10 text-sm text-[#141414] ring-1 ring-black/5 focus:outline-none focus:ring-2 focus:ring-brand transition-all">
                        <svg class="absolute right-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.637 10.637Z"/></svg>
                    </div>

                    <h3 class="text-sm font-extrabold text-[#141414] mb-3 px-1">الأقسام</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-1 gap-2">
                        @foreach ($categories as $cat)
                            @php $count = $cat['id'] === 'all' ? count($products) : ($counts[$cat['id']] ?? 0); @endphp
                            <button type="button"
                                    data-cat="{{ $cat['id'] }}"
                                    onclick="filterProducts('{{ $cat['id'] }}', this)"
                                    class="cat-btn flex items-center justify-between gap-2 px-4 py-3 rounded-xl text-sm font-bold text-right transition-all duration-300
                                           {{ $cat['id'] === 'all' ? 'bg-brand text-white shadow-lg shadow-brand/20' : 'bg-white text-[#4b4b4b] ring-1 ring-black/5 hover:bg-brand-light hover:text-brand' }}">
                                <span>{{ $cat['label'] }}</span>
                                <span class="cat-count text-xs font-extrabold rounded-full px-2 py-0.5 {{ $cat['id'] === 'all' ? 'bg-white/20' : 'bg-brand-light text-brand' }}">{{ $count }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </aside>

            {{-- ===== PRODUCTS (left in RTL) ===== --}}
            <div>
                <div class="flex items-center justify-between mb-6">
                    <p class="text-sm text-[#4b4b4b]"><span id="resultCount" class="font-extrabold text-[#141414]">{{ count($products) }}</span> منتج</p>
                </div>

                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6" id="productsGrid">
                @foreach ($products as $i => $p)
                    <article class="reveal product-card group bg-white rounded-2xl overflow-hidden shadow-sm ring-1 ring-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
                             data-category="{{ $p['cat'] }}"
                             data-name="{{ mb_strtolower($p['name']) }}"
                             data-brand="{{ mb_strtolower($p['brand']) }}"
                             style="transition-delay:{{ $i * 0.05 }}s">
                        {{-- Image --}}
                        <div class="relative h-60 bg-brand-light overflow-hidden">
                            <img src="{{ asset('images/' . $p['img']) }}" alt="{{ $p['name'] }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 right-4 bg-brand text-white text-xs font-bold rounded-full px-3 py-1.5 shadow-md">
                                @if($p['cat'] === 'water') أنظمة المياه @elseif($p['cat'] === 'pools') تجهيزات مسابح @elseif($p['cat'] === 'pumps') مضخات وفلاتر @else مواد كيميائية @endif
                            </span>
                        </div>

                        {{-- Details --}}
                        <div class="p-6">
                            <div class="text-[11px] font-extrabold text-brand uppercase tracking-wider mb-1">{{ $p['brand'] }}</div>
                            <h3 class="product-title text-lg font-bold text-[#141414] mb-3 leading-snug group-hover:text-brand transition-colors">{{ $p['name'] }}</h3>
                            <p class="text-[#4b4b4b] text-sm leading-relaxed mb-5 h-20 overflow-hidden line-clamp-3">{{ $p['desc'] }}</p>
                            
                            {{-- Specs Checklist --}}
                            <div class="border-t border-gray-100 pt-4 pb-5 space-y-2">
                                <span class="text-xs font-extrabold text-[#141414] block">المواصفات الفنية:</span>
                                <ul class="space-y-1.5">
                                    @foreach ($p['specs'] as $spec)
                                        <li class="flex items-center gap-2 text-xs text-[#4b4b4b]">
                                            <svg class="w-3.5 h-3.5 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                            <span>{{ $spec }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Actions --}}
                            <a href="https://wa.me/963112345678?text={{ urlencode('مرحباً مجموعة شورى، أود الاستفسار عن منتج: ' . $p['name'] . ' (' . $p['brand'] . ')') }}" 
                               target="_blank" 
                               class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white py-3 rounded-xl font-bold text-sm transition-colors shadow-md shadow-[#25d366]/15">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.262 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.504-5.728-1.464L0 24zm6.59-4.846c1.6.95 3.197 1.451 4.863 1.452 5.48-.001 9.94-4.46 9.943-9.94.002-2.654-1.031-5.15-2.906-7.028C16.671 1.768 14.17 .732 11.516.732 6.037.732 1.577 5.191 1.574 10.67c-.001 1.764.46 3.49 1.332 5.021l-1.011 3.69 3.753-.984zm12.333-6.52c-.3-.15-1.77-.874-2.043-.973-.274-.1-.473-.15-.673.15-.2.3-.77.973-.943 1.173-.173.2-.347.225-.647.075-.3-.15-1.267-.467-2.413-1.49-1.002-.894-1.396-1.564-1.595-1.9-.2-.33-.021-.508.13-.658.135-.135.3-.35.45-.525.15-.175.2-.299.3-.5.1-.2.05-.375-.025-.525-.075-.15-.673-1.62-.922-2.206-.24-.582-.486-.504-.673-.513-.173-.008-.372-.008-.572-.008-.2 0-.523.075-.797.375-.274.3-1.045 1.021-1.045 2.493 0 1.472 1.07 2.893 1.22 3.093.15.2 2.106 3.216 5.102 4.512.713.31 1.269.493 1.704.632.716.227 1.369.195 1.884.118.574-.085 1.77-.724 2.019-1.396.25-.672.25-1.246.175-1.396-.075-.15-.274-.225-.574-.375z"/></svg>
                                استفسر الآن عبر الواتساب
                            </a>
                        </div>
                    </article>
                @endforeach
                </div>

                {{-- empty state --}}
                <div id="emptyState" class="hidden text-center py-20">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-brand-light text-brand grid place-items-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.637 10.637Z"/></svg>
                    </div>
                    <p class="text-[#4b4b4b] font-bold">لا توجد منتجات مطابقة</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CTA SECTION ===== --}}
    <section class="py-16 bg-[#141414] text-white relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.05]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>
        
        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 text-center">
            <h2 class="text-2xl sm:text-3xl font-black mb-4">هل تحتاج إلى كميات تجارية أو دراسة مخصصة لمشروعك؟</h2>
            <p class="text-white/70 mb-8 max-w-xl mx-auto">تقدم شورى للتجارة عروض أسعار تفضيلية للمقاولين وأصحاب المنشآت والطلبيات الكبيرة في كافة المحافظات.</p>
            <a href="{{ url('/contact') }}?subject={{ urlencode('طلب عرض أسعار كميات') }}" 
               class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                طلب عرض أسعار مخصص
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            </a>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    (function () {
        let activeCat = 'all';
        const grid  = document.getElementById('productsGrid');
        const cards = [...document.querySelectorAll('.product-card')];
        const search = document.getElementById('searchInput');
        const countEl = document.getElementById('resultCount');
        const emptyEl = document.getElementById('emptyState');
        const activeCls = ['bg-brand','text-white','shadow-lg','shadow-brand/20'];
        const idleCls   = ['bg-white','text-[#4b4b4b]','ring-1','ring-black/5','hover:bg-brand-light','hover:text-brand'];

        function setActiveButton(btn) {
            document.querySelectorAll('.cat-btn').forEach(b => {
                b.classList.remove(...activeCls); b.classList.add(...idleCls);
                const c = b.querySelector('.cat-count');
                c.classList.remove('bg-white/20'); c.classList.add('bg-brand-light','text-brand');
            });
            btn.classList.remove(...idleCls); btn.classList.add(...activeCls);
            const c = btn.querySelector('.cat-count');
            c.classList.add('bg-white/20'); c.classList.remove('bg-brand-light','text-brand');
        }

        function apply() {
            const q = (search.value || '').toLowerCase().trim();
            let shown = 0;
            cards.forEach(card => {
                const okCat = activeCat === 'all' || card.dataset.category === activeCat;
                const okQ = !q || card.dataset.name.includes(q) || card.dataset.brand.includes(q);
                const show = okCat && okQ;
                card.classList.toggle('hidden', !show);
                if (show) {
                    shown++;
                    card.classList.remove('anim-pop'); void card.offsetWidth; card.classList.add('anim-pop');
                }
            });
            countEl.textContent = shown;
            emptyEl.classList.toggle('hidden', shown > 0);
            grid.classList.toggle('hidden', shown === 0);
        }

        window.filterProducts = function (catId, button) {
            activeCat = catId;
            setActiveButton(button);
            apply();
        };
        window.searchProducts = apply;
    })();
</script>
@endpush
