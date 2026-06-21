@extends('layouts.app')

@section('title', 'المشاريع | مجموعة شورى')
@section('description', 'تصفح معرض المشاريع الكبرى والناجحة لمجموعة شورى في مجالات محطات المياه، المسابح الأولمبية، المقاولات، والبنى التحتية بمختلف المحافظات السورية.')

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => 'المشاريع',
        'eyebrow' => 'مسيرة حافلة بالإنجازات والعطاء',
        'title'   => 'مشاريعنا',
        'desc'    => 'فخورون بالإسهام في إعمار وتطوير البنية التحتية، وتوفير حلول مائية متطورة للمشاريع السكنية والتجارية والصناعية الكبرى في سوريا.',
    ])

    {{-- ===== PROJECTS SECTION WITH FILTER ===== --}}
    @php
        $filters = [
            ['id' => 'all', 'label' => 'كل المشاريع'],
            ['id' => 'water', 'label' => 'محطات وأنظمة المياه'],
            ['id' => 'pools', 'label' => 'المسابح والبحيرات'],
            ['id' => 'contracting', 'label' => 'المقاولات العامة والإنشاءات'],
        ];

        $projects = [
            [
                'cat' => 'water',
                'title' => 'محطة تحلية مياه الشرب الكبرى',
                'client' => 'القطاع الخاص الخدمي',
                'location' => 'ريف دمشق، سوريا',
                'year' => '2025',
                'desc' => 'تصميم وتوريد وتركيب محطة متكاملة لمعالجة وتحلية مياه الآبار بطاقة إنتاجية عالية لتغذية التجمعات السكانية بالمياه العذبة المطابقة للمواصفات.',
                'img' => 'industrial_bg.png'
            ],
            [
                'cat' => 'pools',
                'title' => 'المجمع المائي الترفيهي الرياضي',
                'client' => 'شركة استثمار سياحي',
                'location' => 'اللاذقية، سوريا',
                'year' => '2024',
                'desc' => 'تصميم وبناء مسبح أولمبي خارجي ومسبح مغلق للأطفال مجهزين بالكامل بأنظمة تسخين مياه شمسية متطورة وأنظمة تنقية رملية وصمامات ذكية.',
                'img' => 'about_skyscrapers.png'
            ],
            [
                'cat' => 'contracting',
                'title' => 'برج شورى التجاري الإداري',
                'client' => 'مجموعة شورى للاستثمار',
                'location' => 'دمشق - أوتستراد المزة، سوريا',
                'year' => '2023',
                'desc' => 'تنفيذ الهيكل الخرساني والإنشائي وعزل كامل الأسطح والجدران لبرج إداري حديث يتألف من 12 طابقاً وفق أحدث النظم الهندسية المقاومة للزلازل.',
                'img' => 'industrial_bg.png'
            ],
            [
                'cat' => 'water',
                'title' => 'محطة معالجة مياه الصرف الصناعي',
                'client' => 'مصنع ألبان وأجبان رائد',
                'location' => 'حماة، سوريا',
                'year' => '2024',
                'desc' => 'تصميم وبناء محطة مخصصة لمعالجة المياه الخارجة من العمليات الصناعية للحد من التلوث وإعادة تدوير المياه للاستخدام الزراعي واستصلاح الأراضي.',
                'img' => 'industrial_bg.png'
            ],
            [
                'cat' => 'pools',
                'title' => 'تأهيل وتحديث مسبح نقابة المهندسين',
                'client' => 'نقابة المهندسين السوريين',
                'location' => 'حلب، سوريا',
                'year' => '2025',
                'desc' => 'إعادة تأهيل وصيانة نظام التصفية الميكانيكي وعزل أرضيات وجدران المسبح المائي وتجهيزه بأنظمة تدفئة متكاملة لخدمة أعضاء النقابة طوال العام.',
                'img' => 'about_skyscrapers.png'
            ],
            [
                'cat' => 'contracting',
                'title' => 'تجهيز شبكات المياه والصرف للمنطقة الصناعية',
                'client' => 'الجهات العامة المحلية',
                'location' => 'حمص، سوريا',
                'year' => '2022',
                'desc' => 'حفر وتمديد وتجهيز خطوط شبكات مياه الشرب والصرف الصحي وقنوات تصريف مياه الأمطار للمنطقة الصناعية الحرفية الجديدة.',
                'img' => 'industrial_bg.png'
            ]
        ];
    @endphp

    <section class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            
            {{-- Category Filter Tabs --}}
            <div class="flex flex-wrap items-center justify-center gap-3 pb-12 border-b border-gray-100">
                @foreach ($filters as $f)
                    <button type="button" 
                            onclick="filterProjects('{{ $f['id'] }}', this)" 
                            class="proj-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300
                                   {{ $f['id'] === 'all' ? 'bg-brand text-white shadow-lg shadow-brand/20' : 'bg-[#f7f7f8] text-[#4b4b4b] hover:bg-gray-200' }}">
                        {{ $f['label'] }}
                    </button>
                @endforeach
            </div>

            {{-- Projects Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 pt-12" id="projectsGrid">
                @foreach ($projects as $i => $p)
                    <article class="reveal project-card group bg-white rounded-2xl overflow-hidden shadow-sm ring-1 ring-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
                             data-category="{{ $p['cat'] }}"
                             style="transition-delay:{{ $i * 0.05 }}s">
                        
                        {{-- Image with overlay on hover --}}
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('images/' . $p['img']) }}" alt="{{ $p['title'] }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            {{-- Category Badge --}}
                            <span class="absolute top-4 right-4 bg-brand text-white text-xs font-bold rounded-full px-3 py-1.5 shadow-md">
                                @if($p['cat'] === 'water') مياه ومعالجة @elseif($p['cat'] === 'pools') مسابح وبحيرات @else مقاولات وإعمار @endif
                            </span>

                            {{-- Project Year & Location --}}
                            <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-xs text-white bg-[#141414]/70 backdrop-blur-sm px-3.5 py-2.5 rounded-xl">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                    {{ $p['location'] }}
                                </span>
                                <span class="font-bold text-brand">{{ $p['year'] }}</span>
                            </div>
                        </div>

                        {{-- Details --}}
                        <div class="p-6">
                            <div class="text-[11px] font-bold text-brand mb-1">العميل: {{ $p['client'] }}</div>
                            <h3 class="text-xl font-bold text-[#141414] mb-3 leading-snug group-hover:text-brand transition-colors">{{ $p['title'] }}</h3>
                            <p class="text-[#4b4b4b] text-sm leading-relaxed mb-4 h-24 overflow-hidden line-clamp-4">{{ $p['desc'] }}</p>
                            
                            <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                                <a href="{{ url('/contact') }}?project={{ urlencode($p['title']) }}" 
                                   class="inline-flex items-center gap-1 text-brand font-bold text-sm hover:gap-2 transition-all">
                                    استفسر عن تفاصيل المشروع
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== STATS COUNTER SECTION ===== --}}
    <section class="py-20 bg-[#141414] text-white relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.05]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>
        
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-10 text-center">
                @php
                    $stats = [
                        ['num' => '+50', 'label' => 'مشروع حيوي منجز'],
                        ['num' => '+15', 'label' => 'عاماً من التميز والإتقان'],
                        ['num' => '100%', 'label' => 'نسبة رضا عملائنا'],
                        ['num' => '+10M', 'label' => 'لتر مياه معالج يومياً']
                    ];
                @endphp
                @foreach ($stats as $stat)
                    <div class="reveal">
                        <div class="text-4xl sm:text-5xl font-black text-brand mb-2">{{ $stat['num'] }}</div>
                        <div class="text-white/70 text-sm font-medium">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== CTA SECTION ===== --}}
    <section class="py-20 bg-white">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 text-center reveal">
            <h2 class="text-2xl sm:text-3xl font-black text-[#141414] mb-4">هل ترغب في التعاون لتنفيذ مشروعك القادم؟</h2>
            <p class="text-[#4b4b4b] mb-8 max-w-xl mx-auto">نحن نلتزم بتقديم دراسة هندسية وافية وحلول تمويلية وتنفيذية تضمن تحقيق أهدافك على أكمل وجه وبأفضل ميزانية.</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-7 py-3.5 rounded-lg font-bold transition-colors">
                    ابدأ مشروعك معنا
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
                <a href="{{ url('/services') }}" class="inline-flex items-center gap-2 border-2 border-[#141414] hover:bg-[#141414] hover:text-white text-[#141414] px-7 py-3 rounded-lg font-bold transition-colors">
                    اطلع على كامل خدماتنا
                </a>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    function filterProjects(catId, button) {
        // Update active class on buttons
        document.querySelectorAll('.proj-btn').forEach(btn => {
            btn.className = "proj-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 bg-[#f7f7f8] text-[#4b4b4b] hover:bg-gray-200";
        });
        button.className = "proj-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 bg-brand text-white shadow-lg shadow-brand/20";

        // Show/hide cards based on category
        const cards = document.querySelectorAll('.project-card');
        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (catId === 'all' || cardCat === catId) {
                card.style.display = 'block';
                card.classList.add('in-view');
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endpush
