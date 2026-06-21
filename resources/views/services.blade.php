@extends('layouts.app')

@section('title', 'خدماتنا | مجموعة شورى')
@section('description', 'تعرف على الخدمات المتكاملة لمجموعة شورى في مجالات معالجة المياه، تصميم المسابح، المقاولات العامة، الصيانة والتشغيل والاستشارات الهندسية في سوريا.')

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
                <span class="text-[#141414] font-medium">خدماتنا</span>
            </nav>
            <span class="inline-block text-brand font-bold text-xs tracking-widest uppercase mb-3">حلول متكاملة ومبتكرة</span>
            <h1 class="text-3xl sm:text-4xl font-black text-[#141414] mb-3">خدماتنا</h1>
            <p class="max-w-xl text-[#555] leading-loose text-[15px]">
                نقدم باقة شاملة من الخدمات الهندسية والفنية والتجارية المصممة لتلبية احتياجات عملائنا بأعلى معايير الجودة والكفاءة.
            </p>
        </div>
    </section>

    {{-- ===== DETAILED SERVICES SECTION ===== --}}
    @php
        $services = [
            [
                'title' => 'أنظمة معالجة وتحلية المياه',
                'dept' => 'قسم معالجة وتحلية المياه',
                'desc' => 'نقدم حلولاً هندسية متكاملة لتصميم وتركيب وتشغيل محطات معالجة وتحلية المياه للقطاعات السكنية والتجارية والصناعية، مع الالتزام التام بالمعايير البيئية والصحية العالمية.',
                'icon' => 'M12 3c-3.5 4-6 7.2-6 10.5a6 6 0 0 0 12 0C18 10.2 15.5 7 12 3Z',
                'features' => ['محطات تحلية المياه بالتناضح العكسي (RO)', 'فلاتر إزالة الحديد والمنغنيز والشوائب', 'أنظمة تعقيم المياه بالأشعة فوق البنفسجية والأوزون', 'معالجة مياه الصرف الصحي وإعادة تدويرها'],
                'image' => 'industrial_bg.png'
            ],
            [
                'title' => 'تصميم وتنفيذ المسابح والبحيرات',
                'dept' => 'قسم المسابح والبحيرات',
                'desc' => 'نترجم تطلعاتكم إلى واقع ملموس من خلال تصميم وبناء المسابح والبحيرات الاصطناعية بمختلف الأشكال والأحجام، مجهزة بأحدث أنظمة الفلترة، التدفئة، والإضاءة الذكية.',
                'icon' => 'M3 18c1.5 0 1.5-1 3-1s1.5 1 3 1 1.5-1 3-1 1.5 1 3 1 1.5-1 3-1 1.5 1 3 1M3 14c1.5 0 1.5-1 3-1s1.5 1 3 1 1.5-1 3-1 1.5 1 3 1 1.5-1 3-1 1.5 1 3 1M6 10V5a2 2 0 0 1 4 0M14 10V5a2 2 0 0 1 4 0',
                'features' => ['تصاميم ثلاثية الأبعاد (3D) قبل التنفيذ', 'إنشاء الهياكل الخرسانية والعزل المائي المضمون', 'تركيب أنظمة الفلترة والتعقيم الكيميائي والملحي', 'أنظمة التدفئة بالطاقة الشمسية والمضخات الحرارية'],
                'image' => 'about_skyscrapers.png'
            ],
            [
                'title' => 'المقاولات العامة والإنشائية',
                'dept' => 'قسم المقاولات والإنشاءات',
                'desc' => 'نقوم بتنفيذ المشاريع السكنية والتجارية والبنية التحتية بكوادر هندسية وفنية مؤهلة، مستخدمين أفضل المواد والمعدات لضمان السلامة الإنشائية والجمالية.',
                'icon' => 'M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 11h.01M15 11h.01',
                'features' => ['أعمال التشييد والبناء المتكاملة (عظم ومفتاح)', 'تنفيذ البنى التحتية وشبكات الصرف والمياه', 'أعمال العزل الحراري والمائي للأسطح والمنشآت', 'إشراف هندسي مستمر لضمان تطابق المخططات'],
                'image' => 'industrial_bg.png'
            ],
            [
                'title' => 'الصيانة والتشغيل الدوري',
                'dept' => 'قسم الصيانة والتشغيل',
                'desc' => 'نضمن استدامة عمل أنظمتكم ومعداتكم بأقصى كفاءة من خلال برامج صيانة وقائية وعلاجية دورية تحت إشراف مهندسين وفنيين مختصين.',
                'icon' => 'M11.4 2.6a5 5 0 0 0 6 6L21 12l-2 2-3.4-3.4a5 5 0 0 1-6-6L7 1l4.4 1.6ZM3 17l6-6M3 17l3 3 6-6',
                'features' => ['عقود صيانة دورية للمحطات والمسابح', 'فحص وتحليل جودة المياه وتعديل الخواص الكيميائية', 'توفير وتغيير قطع الغيار الأصلية والمستهلكات', 'استجابة سريعة للأعطال الطارئة على مدار الساعة'],
                'image' => 'about_skyscrapers.png'
            ],
            [
                'title' => 'توريد المعدات والمستلزمات',
                'dept' => 'قسم التجارة والتوريد',
                'desc' => 'نستورد ونوفر باقة واسعة من المضخات، الفلاتر، والمواد الكيميائية من كبرى الماركات العالمية لضمان حصول عملائنا على أفضل المنتجات المعتمدة.',
                'icon' => 'M3 9l9-6 9 6v9a2 2 0 0 1-2 2h-5v-6H10v6H5a2 2 0 0 1-2-2V9Z',
                'features' => ['مضخات المياه المنزلية، الصناعية، والغاطسة', 'أنظمة فلاتر رملية وقطنية متعددة الأحجام', 'مواد تعقيم المسابح والمحطات (كلور، أسيد، مانع طحالب)', 'إكسسوارات ومعدات الإضاءة المائية الحديثة'],
                'image' => 'industrial_bg.png'
            ],
            [
                'title' => 'الاستشارات والدراسات الهندسية',
                'dept' => 'قسم الاستشارات الهندسية',
                'desc' => 'نقدم دراسات جدوى هندسية وتصاميم فنية متطورة للمشاريع المائية والإنشائية لمساعدتكم في اختيار الحل الأمثل والأكثر جدوى اقتصادية.',
                'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M3 9h2m-2 6h2m14-6h2m-2 6h2M7 7h10v10H7z',
                'features' => ['حساب وتقدير تكاليف المشاريع ومسح الكميات', 'دراسة وتحليل عينات المياه وتقديم حلول الفلترة', 'تطوير مخططات هيدروليكية وميكانيكية متكاملة', 'الاستشارات البيئية واستدامة الموارد المائية'],
                'image' => 'about_skyscrapers.png'
            ],
        ];
    @endphp

    <section class="py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 space-y-20 lg:space-y-28">
            @foreach ($services as $i => $s)
                @php $isEven = $i % 2 === 0; @endphp
                <div class="reveal grid lg:grid-cols-12 gap-10 lg:gap-16 items-center">
                    {{-- Content --}}
                    <div class="lg:col-span-7 space-y-6 {{ $isEven ? 'order-2 lg:order-1 text-right' : 'order-2 text-right' }}">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-brand-light text-brand">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="{{ $s['icon'] }}"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-black text-[#141414]">{{ $s['title'] }}</h2>
                        <p class="text-[#4b4b4b] leading-loose text-[15px]">{{ $s['desc'] }}</p>

                        <ul class="grid sm:grid-cols-2 gap-3 pt-3">
                            @foreach ($s['features'] as $feat)
                                <li class="flex items-start gap-2.5 text-sm text-[#4b4b4b]">
                                    <svg class="w-4 h-4 text-brand shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                    <span>{{ $feat }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="pt-4 flex flex-wrap gap-4">
                            <a href="{{ url('/contact') }}?service={{ urlencode($s['title']) }}&department={{ urlencode($s['dept']) }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-6 py-2.5 rounded-lg font-bold text-sm transition-colors">
                                اطلب الخدمة الآن
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Graphic / Image --}}
                    <div class="lg:col-span-5 {{ $isEven ? 'order-1 lg:order-2' : 'order-1' }}">
                        <div class="relative overflow-hidden rounded-[2rem] shadow-xl group">
                            <div class="absolute inset-0 bg-brand/10 opacity-0 group-hover:opacity-100 transition-opacity z-10"></div>
                            <img src="{{ asset('images/' . $s['image']) }}" alt="{{ $s['title'] }}" class="w-full h-72 sm:h-96 object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                </div>
                @if (!$loop->last)
                    <hr class="border-gray-100">
                @endif
            @endforeach
        </div>
    </section>

    {{-- ===== WHY CHOOSE US ===== --}}
    <section class="py-20 lg:py-28 bg-[#f7f7f8] relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.03]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">مميزاتنا</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414] mb-4">لماذا تختار مجموعة شورى؟</h2>
                <p class="text-[#4b4b4b] leading-relaxed">
                    نحن نضمن لعملائنا جودة التنفيذ والالتزام التام بالتفاصيل والمواعيد، مدعومين بسنوات من الخبرة الطويلة في السوق السوري.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $benefits = [
                        ['title' => 'الخبرة التخصصية', 'desc' => 'نمتلك فريقاً هندسياً وفنياً متكاملاً يتمتع بخبرات ممتدة تضمن تفادي الأخطاء وتقديم الحلول الفعّالة.', 'icon' => 'M9.663 17h4.673M12 3v1m6.364.364-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 1 1 7.072 0l-.548.547A3.374 3.374 0 0 0 14 18.469V19a2 2 0 1 1-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                        ['title' => 'أعلى معايير الجودة', 'desc' => 'لا نساوم على الجودة؛ نستخدم فقط المواد والمعدات الأصلية المطابقة للمواصفات العالمية والمجربة كفاءتها.', 'icon' => 'M9 12l2 2 4-4M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
                        ['title' => 'الالتزام التام بالمواعيد', 'desc' => 'ندير مشاريعنا وفق جداول زمنية دقيقة ونلتزم بتسليم الأعمال المطلوبة في أوقاتها المحددة دون تأخير.', 'icon' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
                        ['title' => 'دعم فني متواصل', 'desc' => 'علاقتنا مع العميل لا تنتهي بانتهاء المشروع، بل نقدم عقود صيانة دورية وضمانات حقيقية ودعماً فنياً مستمراً.', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z']
                    ];
                @endphp

                @foreach ($benefits as $i => $b)
                    <div class="reveal bg-white rounded-2xl p-7 shadow-sm ring-1 ring-black/5 hover:shadow-xl transition-all"
                         style="transition-delay:{{ $i * 0.08 }}s">
                        <div class="w-12 h-12 rounded-xl bg-brand text-white grid place-items-center mb-5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="{{ $b['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-[#141414] mb-3">{{ $b['title'] }}</h3>
                        <p class="text-[#4b4b4b] text-sm leading-relaxed">{{ $b['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== CTA ===== --}}
    <section class="py-20 bg-white">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 text-center reveal">
            <h2 class="text-2xl sm:text-3xl font-black text-[#141414] mb-4">هل لديك مشروع تود مناقشته مع خبرائنا؟</h2>
            <p class="text-[#4b4b4b] mb-8 max-w-xl mx-auto">فريق مجموعة شورى جاهز لتقديم الاستشارات الفنية المجانية ودراسة متطلبات مشروعك بكل دقة.</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-7 py-3 rounded-lg font-bold transition-colors">
                    تواصل معنا الآن
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
                <a href="{{ url('/companies') }}" class="inline-flex items-center gap-2 border-2 border-[#141414] hover:bg-[#141414] hover:text-white text-[#141414] px-7 py-3 rounded-lg font-bold transition-colors">
                    تعرّف على شركاتنا
                </a>
            </div>
        </div>
    </section>

@endsection
