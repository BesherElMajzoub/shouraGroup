@extends('layouts.app')

@section('title', 'مجموعة شورى')

@section('content')

    {{-- ============ 3) HERO ============ --}}
    @php
        $chips = [
            ['label' => 'مجموعات التوليد',      'top' => 6,  'left' => 10, 'size' => 5.5, 'r' => -8, 'd' => 0.0],
            ['label' => 'مضخات المياه',          'top' => 14, 'left' => 78, 'size' => 6,   'r' => 6,  'd' => 0.6],
            ['label' => 'ضواغط الهواء',          'top' => 2,  'left' => 44, 'size' => 4.5, 'r' => 4,  'd' => 1.2],
            ['label' => 'غازات طبية',            'top' => 40, 'left' => 4,  'size' => 5,   'r' => 10, 'd' => 0.3],
            ['label' => 'تجهيزات كهربائية',      'top' => 46, 'left' => 88, 'size' => 4.5, 'r' => -6, 'd' => 0.9],
            ['label' => 'عُدد صناعية',           'top' => 70, 'left' => 14, 'size' => 4,   'r' => -12,'d' => 1.5],
            ['label' => 'تطوير عقاري',           'top' => 76, 'left' => 70, 'size' => 5,   'r' => 8,  'd' => 0.4],
            ['label' => 'قطاع عام',              'top' => 24, 'left' => 26, 'size' => 4,   'r' => 12, 'd' => 1.1],
            ['label' => 'منذ عام 1978',          'top' => 30, 'left' => 62, 'size' => 4.5, 'r' => -10,'d' => 0.7],
        ];
    @endphp
    <section id="hero" class="relative overflow-hidden bg-gradient-to-b from-brand-light/60 to-white scroll-mt-24">
        <div class="pointer-events-none absolute inset-0 opacity-[0.04]"
             style="background-image:radial-gradient(#141414 1px, transparent 1px); background-size:22px 22px;"></div>

        <div class="hidden lg:block absolute inset-0 pointer-events-none">
            @foreach ($chips as $c)
                <div class="absolute anim-float"
                     style="top:{{ $c['top'] }}%; left:{{ $c['left'] }}%; --r:{{ $c['r'] }}deg;
                            width:{{ $c['size'] }}rem; height:{{ $c['size'] }}rem;
                            animation-delay:{{ $c['d'] }}s; transform:rotate({{ $c['r'] }}deg);">
                    <div class="w-full h-full rounded-2xl bg-white shadow-lg ring-1 ring-black/5 grid place-items-center
                                grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition">
                        <span class="grid place-items-center w-2/3 h-2/3 rounded-full bg-brand-light text-brand font-black text-xl">ش</span>
                    </div>
                    <span class="block mt-1 text-center text-[10px] font-bold text-[#141414]/40">{{ $c['label'] }}</span>
                </div>
            @endforeach
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 py-16 lg:py-28">
            <div class="flex flex-col items-center text-center">
                <div class="relative mb-8 anim-pop">
                    <div class="absolute -inset-8 rounded-full bg-brand/20 blur-3xl anim-glow"></div>
                    <img src="{{ asset('images/shora-logo.svg') }}" alt="مجموعة شورى"
                         class="relative h-28 sm:h-40 w-auto drop-shadow-sm anim-float">
                </div>

                <h1 class="text-3xl sm:text-5xl font-black text-[#141414] leading-tight anim-fade-up" style="animation-delay:.15s">
                    شورى <span class="text-brand">إخوان</span>
                </h1>
                <p class="mt-4 max-w-2xl text-base sm:text-lg text-[#4b4b4b] leading-relaxed anim-fade-up" style="animation-delay:.3s">
                    الشركة الرائدة في التوريدات الهندسية في سوريا منذ عام 1978 — حلول متكاملة في توليد الكهرباء، ضخ المياه، ضواغط الهواء، الغازات الطبية، والتجهيزات الكهربائية.
                </p>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-4 anim-fade-up" style="animation-delay:.45s">
                    <a href="#about" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-7 py-3 rounded-lg font-bold transition-colors">
                        تعرّف علينا
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                    </a>
                    <a href="#contact" class="inline-flex items-center gap-2 border-2 border-[#141414] hover:bg-[#141414] hover:text-white text-[#141414] px-7 py-3 rounded-lg font-bold transition-colors">
                        تواصل معنا
                    </a>
                </div>
            </div>

            <div class="lg:hidden flex flex-wrap items-center justify-center gap-3 mt-12">
                @foreach ($chips as $c)
                    <div class="flex items-center gap-2 bg-white rounded-xl shadow-sm ring-1 ring-black/5 px-3 py-2">
                        <span class="grid place-items-center w-7 h-7 rounded-full bg-brand-light text-brand font-black text-xs">ش</span>
                        <span class="text-xs font-bold text-[#141414]/60">{{ $c['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ 4) ABOUT — من نحن ============ --}}
    <section id="about" class="scroll-mt-24 py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">شورى إخوان</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414] mb-6">من نحن</h2>
                <div class="space-y-4 text-[#4b4b4b] leading-loose text-[15px]">
                    <p>
                        تأسست شركة شورى إخوان في عام 1978 في العاصمة دمشق، وبدأت رحلتها لتصبح اليوم واحدة من أهم الركائز الهندسية والتجارية في السوق السورية. نجحت الشركة في أن تصبح الخيار الأول للمشاريع الاستراتيجية.
                    </p>
                    <p>
                        تسعى شورى إلى التطور في القطاعات التي تعمل بها، مع التركيز على تلبية أعقد دفاتر الشروط للقطاع العام والمنظمات الدولية.
                    </p>
                    <p>
                        مع مرور الزمن، نمت شورى وأنشأت أقساماً متخصصة مدعومة بشراكات عالمية لتصنع مستقبلاً هندسياً واعداً.
                    </p>
                </div>
                <div class="mt-8 grid grid-cols-3 gap-4 max-w-md">
                    @foreach (['+45' => 'عاماً من الخبرة', '+5' => 'أقسام متخصصة', '15+' => 'شراكة عالمية'] as $num => $lbl)
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-black text-brand">{{ $num }}</div>
                            <div class="text-xs text-[#4b4b4b] mt-1">{{ $lbl }}</div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ url('/story') }}" class="inline-flex items-center gap-2 mt-8 text-brand font-bold hover:gap-3 transition-all">
                    اقرأ قصة شورى كاملة
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
            </div>

            <div class="reveal" style="transition-delay:.15s">
                <div class="grid grid-cols-2 gap-4">
                    <img src="{{ asset('images/about_skyscrapers.png') }}" alt="" class="col-span-2 w-full h-56 object-cover rounded-2xl shadow-lg">
                    <img src="{{ asset('images/industrial_bg.png') }}" alt="" class="w-full h-40 object-cover rounded-2xl shadow-lg">
                    <div class="w-full h-40 rounded-2xl bg-brand grid place-items-center shadow-lg">
                        <img src="{{ asset('images/shora-logo.svg') }}" alt="شورى" class="h-16 w-auto brightness-0 invert">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ 5) SERVICES — خدماتنا ============ --}}
    @php
        $services = [
            ['title' => 'تركيب وتسليم مجموعات التوليد', 'desc' => 'تركيب وتسليم مجموعات التوليد الكهربائية الديزل والغاز بقدرات تتراوح بين 20 و2000 KVA.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7Z'],
            ['title' => 'تأهيل محطات ضخ المياه', 'desc' => 'تأهيل محطات ضخ المياه للمنظمات الدولية والجهات الحكومية بأعلى معايير الجودة.', 'icon' => 'M12 3c-3.5 4-6 7.2-6 10.5a6 6 0 0 0 12 0C18 10.2 15.5 7 12 3Z'],
            ['title' => 'تجهيز خطوط الإنتاج بضواغط الهواء', 'desc' => 'تجهيز خطوط الإنتاج والمصانع بضواغط الهواء الكبرى وأنظمة معالجة الهواء والغازات.', 'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M3 9h2m-2 6h2m14-6h2m-2 6h2M7 7h10v10H7z'],
            ['title' => 'أنظمة شبكات الغازات الطبية', 'desc' => 'تنفيذ أنظمة شبكات الغازات الطبية لمختلف المشافي والمراكز الصحية وفق المعايير الدولية.', 'icon' => 'M19 7H5M19 12H5M19 17H5M3 7h.01M3 12h.01M3 17h.01'],
            ['title' => 'مبيعات الجملة والتجزئة', 'desc' => 'تزويد التجار والمقاولين بمختلف منتجاتنا من معدات ومستلزمات هندسية عبر قنوات مبيعات الجملة.', 'icon' => 'M3 9l9-6 9 6v9a2 2 0 0 1-2 2h-5v-6H10v6H5a2 2 0 0 1-2-2V9Z'],
            ['title' => 'التجهيزات الكهربائية والعُدد الصناعية', 'desc' => 'توريد القواطع والكنتكتورات وقواطع التوتر المتوسط والعُدد الصناعية من كبرى العلامات العالمية.', 'icon' => 'M11.4 2.6a5 5 0 0 0 6 6L21 12l-2 2-3.4-3.4a5 5 0 0 1-6-6L7 1l4.4 1.6ZM3 17l6-6M3 17l3 3 6-6'],
        ];
    @endphp
    <section id="services" class="scroll-mt-24 py-20 lg:py-28 bg-[#f7f7f8]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">ماذا نقدّم</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414] mb-4">الخدمات والحلول</h2>
                <p class="text-[#4b4b4b] leading-relaxed">
                    باقة متكاملة من الحلول الهندسية المتخصصة — من التوريد والتركيب إلى ما بعد البيع، نكون إلى جانبك في كل مرحلة.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($services as $i => $s)
                    <div class="reveal group bg-white rounded-2xl p-7 shadow-sm ring-1 ring-black/5
                                hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                         style="transition-delay:{{ $i * 0.08 }}s">
                        <div class="w-14 h-14 rounded-xl bg-brand-light text-brand grid place-items-center mb-5
                                    group-hover:bg-brand group-hover:text-white transition-colors">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.7"
                                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="{{ $s['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-[#141414] mb-2">{{ $s['title'] }}</h3>
                        <p class="text-[#4b4b4b] text-sm leading-relaxed">{{ $s['desc'] }}</p>
                        <a href="#contact" class="inline-flex items-center gap-1 mt-4 text-brand font-bold text-sm
                                  opacity-0 group-hover:opacity-100 transition-opacity">
                            اطلب الخدمة
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ 6) VISION & MISSION — الرؤية والرسالة ============ --}}
    <section id="vision" class="scroll-mt-24 relative overflow-hidden bg-white">
        <div class="pointer-events-none absolute inset-0 opacity-[0.04]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="hidden lg:block absolute inset-y-0 left-0 w-[55%]">
            <img src="{{ asset('images/shora-building.jpg') }}" alt="مبنى مجموعة شورى"
                 class="w-full h-full object-cover"
                 style="-webkit-mask-image:linear-gradient(to right,#000 45%,transparent 92%); mask-image:linear-gradient(to right,#000 45%,transparent 92%);">
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 py-16 lg:py-28">
            <div class="lg:hidden mb-10 reveal">
                <img src="{{ asset('images/shora-building.jpg') }}" alt="مبنى مجموعة شورى"
                     class="w-full h-56 object-cover rounded-3xl shadow-xl">
            </div>

            <div class="lg:w-[46%] space-y-14">
                <div class="reveal flex items-start gap-7">
                    <div class="flex-1 pt-2">
                        <h3 class="text-3xl font-black text-[#141414] mb-4">الرؤية</h3>
                        <p class="text-[#4b4b4b] leading-loose text-[15px]">
                            تحقيق الريادة في تقديم حلول هندسية متكاملة في قطاعات الطاقة والمياه على مستوى سوريا والمنطقة.
                        </p>
                    </div>
                    <div class="relative shrink-0 anim-float">
                        <div class="absolute -inset-2.5 rounded-full border-2 border-dashed border-brand/40"></div>
                        <div class="w-24 h-24 rounded-full bg-brand text-white grid place-items-center shadow-xl shadow-brand/30">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        </div>
                    </div>
                </div>

                <div class="reveal flex items-start gap-7" style="transition-delay:.15s">
                    <div class="flex-1 pt-2">
                        <h3 class="text-3xl font-black text-[#141414] mb-4">الرسالة</h3>
                        <p class="text-[#4b4b4b] leading-loose text-[15px]">
                            توفير منتجات عالمية الجودة، وخدمات ما بعد البيع استثنائية، وتقديم أفضل الحلول المتكاملة لعملائنا في القطاعين العام والخاص والمنظمات الدولية.
                        </p>
                    </div>
                    <div class="relative shrink-0 anim-float" style="animation-delay:1s">
                        <div class="w-24 h-24 rounded-full grid place-items-center shadow-xl text-white"
                             style="background-image:linear-gradient(145deg,#2a2a2a,#141414);">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ 7) COMPANIES — شركاتنا (سلايدر) ============ --}}
    @php
        $companies = [
            ['name' => 'مجموعات التوليد',         'tag' => 'ديزل وغاز 20-2000 KVA',       'desc' => 'محطات كهرباء احتياطية ديزل وغاز بقدرات تتراوح بين 20 و2000 KVA للقطاعين العام والخاص.'],
            ['name' => 'مضخات المياه وملحقاتها',  'tag' => 'ضخ المياه',                    'desc' => 'توريد وتركيب مضخات المياه بمختلف أنواعها وملحقاتها لتأهيل محطات الضخ ومشاريع المياه.'],
            ['name' => 'ضواغط الهواء والغاز',     'tag' => 'أنظمة الضغط ومعالجة الهواء',   'desc' => 'أنظمة ضواغط الهواء والغاز ومعالجة الهواء والغازات الصناعية لتجهيز خطوط الإنتاج.'],
            ['name' => 'شبكات الغازات الطبية',    'tag' => 'مشافي ومراكز صحية',            'desc' => 'تصميم وتنفيذ أنظمة شبكات الغازات الطبية للمشافي والمراكز الصحية وفق المعايير الدولية.'],
            ['name' => 'التجهيزات الكهربائية',    'tag' => 'عُدد ومعدات صناعية',           'desc' => 'قواطع وكنتكتورات وقواطع توتر متوسط وعُدد صناعية من كبرى العلامات العالمية.'],
        ];
    @endphp
    <section id="companies" class="scroll-mt-24 py-20 lg:py-28 bg-[#f7f7f8]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-12 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">المجموعة</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">شركاتنا</h2>
            </div>

            <div class="reveal relative rounded-[2.5rem] bg-[#141414] overflow-hidden p-8 sm:p-12 lg:p-16">
                <img src="{{ asset('images/shora-logo.svg') }}" alt=""
                     class="pointer-events-none absolute -left-16 -bottom-16 w-[34rem] opacity-[0.05] brightness-0 invert">
                <span class="pointer-events-none select-none absolute inset-x-0 top-1/2 -translate-y-1/2 text-center
                             text-white/[0.03] font-black text-[7rem] lg:text-[11rem] leading-none whitespace-nowrap">SHORA GROUP</span>

                {{-- Coverflow stage: الشركة النشطة كبيرة والباقي صغار --}}
                <div id="compStage" dir="ltr" class="relative h-72 sm:h-80">
                    @foreach ($companies as $i => $co)
                        <div class="comp-slide absolute top-1/2 left-1/2 w-52 sm:w-64"
                             data-index="{{ $i }}" data-desc="{{ $co['desc'] }}"
                             style="transform:translate(-50%,-50%); transition:transform .55s cubic-bezier(.4,0,.2,1), opacity .55s;">
                            <div class="comp-card-inner rounded-3xl p-6 text-center cursor-pointer">
                                <div class="h-24 grid place-items-center mb-3">
                                    <img src="{{ asset('images/shora-logo.svg') }}" alt="{{ $co['name'] }}" class="c-logo h-14 w-auto transition">
                                </div>
                                <h3 class="c-name text-lg sm:text-xl font-black mb-2.5 transition-colors">{{ $co['name'] }}</h3>
                                <span class="c-tag inline-block text-xs font-bold rounded-full px-3 py-1 transition-opacity"
                                      style="background:rgba(225,29,38,.1); color:#e11d26;">{{ $co['tag'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- وصف الشركة النشطة --}}
                <p id="featDesc" dir="rtl" style="min-height:3.5rem;" class="relative text-center text-white/70 leading-loose max-w-xl mx-auto mt-8 transition-opacity duration-300">{{ $companies[0]['desc'] }}</p>

                {{-- أدوات التحكّم --}}
                <div class="relative flex items-center justify-center gap-4 mt-6">
                    <button id="compPrev" type="button" aria-label="السابق" class="w-11 h-11 rounded-full bg-white/10 hover:bg-brand text-white grid place-items-center transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                    <div id="compDots" class="flex items-center justify-center gap-2">
                        @foreach ($companies as $i => $co)
                            <button type="button" class="comp-dot h-2 rounded-full transition-all duration-300 {{ $i === 0 ? 'w-7 bg-brand' : 'w-2 bg-white/30' }}" data-index="{{ $i }}" aria-label="{{ $co['name'] }}"></button>
                        @endforeach
                    </div>
                    <button id="compNext" type="button" aria-label="التالي" class="w-11 h-11 rounded-full bg-white/10 hover:bg-brand text-white grid place-items-center transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5l-7 7 7 7"/></svg>
                    </button>
                </div>

                {{-- حالات النشط/غير النشط --}}
                <style>
                    .comp-card-inner{ background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.12); }
                    .comp-slide .c-logo{ filter:brightness(0) invert(1); opacity:.5; }
                    .comp-slide .c-name{ color:rgba(255,255,255,.6); }
                    .comp-slide .c-tag{ opacity:0; }
                    .comp-slide.is-active .comp-card-inner{ background:#fff; border-color:#fff; box-shadow:0 25px 50px -12px rgba(0,0,0,.55); }
                    .comp-slide.is-active .c-logo{ filter:none; opacity:1; }
                    .comp-slide.is-active .c-name{ color:#141414; }
                    .comp-slide.is-active .c-tag{ opacity:1; }
                </style>
            </div>
        </div>
    </section>

    {{-- ============ 8) SECTORS — قطاعاتنا ============ --}}
    @php
        $iconWater   = 'M12 3c-3.5 4-6 7.2-6 10.5a6 6 0 0 0 12 0C18 10.2 15.5 7 12 3Z';
        $iconPool    = 'M3 18c1.5 0 1.5-1 3-1s1.5 1 3 1 1.5-1 3-1 1.5 1 3 1 1.5-1 3-1 1.5 1 3 1M3 14c1.5 0 1.5-1 3-1s1.5 1 3 1 1.5-1 3-1 1.5 1 3 1 1.5-1 3-1 1.5 1 3 1M7 10V5a2 2 0 0 1 4 0M15 10V5a2 2 0 0 1 4 0';
        $iconBuild   = 'M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 11h.01M15 11h.01';
        $iconFire    = 'M9 21h6M10 21v-3m4 3v-3M12 3c1 2 3 3 3 6a3 3 0 0 1-6 0c0-1 .5-2 1-2.5M8 14a4 4 0 0 0 8 0';
        $iconPump    = 'M3 9l9-6 9 6v9a2 2 0 0 1-2 2h-5v-6H10v6H5a2 2 0 0 1-2-2V9Z';
        $iconPipe    = 'M4 8h8a4 4 0 0 1 4 4v8M4 8v8a4 4 0 0 0 4 4h12M4 8V4M16 20h4';
        $iconWrench  = 'M11.4 2.6a5 5 0 0 0 6 6L21 12l-2 2-3.4-3.4a5 5 0 0 1-6-6L7 1l4.4 1.6ZM3 17l6-6M3 17l3 3 6-6';
        $iconPlan    = 'M9 3v2m6-2v2M9 19v2m6-2v2M3 9h2m-2 6h2m14-6h2m-2 6h2M7 7h10v10H7z';
        $iconSubmer  = 'M12 2v4m-3 2h6l1 5a4 4 0 0 1-8 0l1-5ZM5 22h14';

        $right = [
            ['t' => 'محطات كهرباء احتياطية ديزل وغاز (20-2000 KVA)', 'i' => $iconFire],
            ['t' => 'مضخات المياه وملحقاتها لمحطات الضخ', 'i' => $iconWater],
            ['t' => 'ضواغط الهواء والغاز ومعالجة الهواء', 'i' => $iconPipe],
            ['t' => 'أنظمة شبكات الغازات الطبية للمشافي', 'i' => $iconPool],
        ];
        $left = [
            ['t' => 'التجهيزات الكهربائية والعُدد الصناعية', 'i' => $iconPlan],
            ['t' => 'قواطع وكنتكتورات وقواطع توتر متوسط', 'i' => $iconBuild],
            ['t' => 'خدمات ما بعد البيع والصيانة الدورية', 'i' => $iconWrench],
            ['t' => 'تأهيل المشاريع للقطاع العام والمنظمات الدولية', 'i' => $iconSubmer],
        ];
    @endphp
    <section id="sectors" class="scroll-mt-24 py-20 lg:py-28 bg-white relative overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <h2 class="text-3xl sm:text-4xl font-black text-[#141414] text-center mb-14 reveal">قطاعاتنا</h2>

            <div class="grid lg:grid-cols-3 gap-6 lg:gap-8 items-center">
                <div class="space-y-5 order-2 lg:order-1">
                    @foreach ($right as $i => $s)
                        <div class="reveal bg-white rounded-2xl shadow-md ring-1 ring-black/5 p-5 flex items-center gap-4
                                    hover:shadow-xl hover:-translate-y-0.5 transition-all" style="transition-delay:{{ $i*0.06 }}s">
                            <p class="flex-1 text-[15px] font-bold text-[#141414] leading-relaxed text-right">{{ $s['t'] }}</p>
                            <span class="shrink-0 w-12 h-12 rounded-xl bg-brand-light text-brand grid place-items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $s['i'] }}"/></svg>
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="order-1 lg:order-2 reveal">
                    <div class="relative w-72 h-72 sm:w-80 sm:h-80 mx-auto">
                        <div class="absolute inset-0 rounded-full overflow-hidden ring-2 ring-brand/20 shadow-2xl">
                            <img src="{{ asset('images/industrial_bg.png') }}" alt="مجموعة شورى" class="w-full h-full object-cover">
                            <div class="absolute inset-0" style="background-image:linear-gradient(to bottom,#ffffffee 0%,#ffffff55 28%,transparent 55%);"></div>
                            <div class="absolute bottom-0 inset-x-0 bg-[#141414]/70 py-2 grid place-items-center">
                                <img src="{{ asset('images/shora-logo.svg') }}" alt="" class="h-7 w-auto brightness-0 invert">
                            </div>
                        </div>
                        <div class="absolute top-6 inset-x-0 flex items-center justify-center gap-3">
                            <span class="text-6xl font-black text-brand leading-none">1978</span>
                            <span class="text-sm font-bold text-[#141414] leading-tight text-right">منذ عام<br>نبني الثقة</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-5 order-3">
                    @foreach ($left as $i => $s)
                        <div class="reveal bg-white rounded-2xl shadow-md ring-1 ring-black/5 p-5 flex items-center gap-4
                                    hover:shadow-xl hover:-translate-y-0.5 transition-all" style="transition-delay:{{ $i*0.06 }}s">
                            <span class="shrink-0 w-12 h-12 rounded-xl bg-brand-light text-brand grid place-items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $s['i'] }}"/></svg>
                            </span>
                            <p class="flex-1 text-[15px] font-bold text-[#141414] leading-relaxed text-right">{{ $s['t'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="reveal mt-6 max-w-sm mx-auto bg-white rounded-2xl shadow-md ring-1 ring-black/5 p-5 flex items-center gap-4
                        hover:shadow-xl hover:-translate-y-0.5 transition-all">
                <p class="flex-1 text-[15px] font-bold text-[#141414] leading-relaxed text-right">توريد وتركيب المضخات الغاطسة</p>
                <span class="shrink-0 w-12 h-12 rounded-xl bg-brand-light text-brand grid place-items-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $iconSubmer }}"/></svg>
                </span>
            </div>
        </div>
    </section>

    {{-- ============ PLACEHOLDERS ============ --}}
    <section id="products"  class="scroll-mt-24"></section>
    <section id="careers"   class="scroll-mt-24"></section>

    {{-- ============ 9) NEWS — الأخبار ============ --}}
    @php
        $news = [
            ['cat' => 'مشاريع', 'date' => '12 حزيران 2026', 'title' => 'شورى تنجز محطة تحلية مياه جديدة في ريف دمشق', 'desc' => 'أتمّت مجموعة شورى تنفيذ وتشغيل محطة تحلية ومعالجة مياه بطاقة إنتاجية عالية لخدمة المنطقة.', 'img' => 'industrial_bg.png'],
            ['cat' => 'شراكات', 'date' => '28 أيار 2026', 'title' => 'توقيع اتفاقية توريد معدات مسابح مع علامة عالمية', 'desc' => 'وقّعت شورى اتفاقية شراكة لتوريد أحدث أنظمة التنقية والمضخات للمسابح في السوق السوري.', 'img' => 'about_skyscrapers.png'],
            ['cat' => 'إنجازات', 'date' => '10 أيار 2026', 'title' => 'افتتاح فرع جديد للمجموعة في حلب', 'desc' => 'ضمن خطة التوسّع، افتتحت مجموعة شورى فرعاً جديداً لتقديم خدماتها لعملائها في المنطقة الشمالية.', 'img' => 'saudi_map.png'],
        ];
    @endphp
    <section id="news" class="scroll-mt-24 py-20 lg:py-28 bg-[#f7f7f8]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="flex items-end justify-between gap-4 mb-12 reveal">
                <div>
                    <span class="inline-block text-brand font-bold text-sm mb-3">آخر المستجدّات</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">الأخبار</h2>
                </div>
                <a href="#" class="hidden sm:inline-flex items-center gap-2 text-brand font-bold text-sm hover:gap-3 transition-all">
                    كل الأخبار
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($news as $i => $n)
                    <article class="reveal group bg-white rounded-2xl overflow-hidden shadow-sm ring-1 ring-black/5
                                    hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                             style="transition-delay:{{ $i*0.08 }}s">
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ asset('images/'.$n['img']) }}" alt="{{ $n['title'] }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 right-4 bg-brand text-white text-xs font-bold rounded-full px-3 py-1">{{ $n['cat'] }}</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-[#9a9a9a] mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                {{ $n['date'] }}
                            </div>
                            <h3 class="text-lg font-bold text-[#141414] mb-2 leading-snug group-hover:text-brand transition-colors">{{ $n['title'] }}</h3>
                            <p class="text-[#4b4b4b] text-sm leading-relaxed mb-4">{{ $n['desc'] }}</p>
                            <a href="#" class="inline-flex items-center gap-1 text-brand font-bold text-sm">
                                اقرأ المزيد
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ 10) BRANCHES — فروع شركتنا ============ --}}
    @php
        $branches = [
            ['name' => 'دمشق – المرجة',    'addr' => 'دمشق، المرجة — صالة عرض ومبيعات مفرق وجملة',  'phone' => '+963 11 234 5678', 'top' => 78, 'left' => 9],
            ['name' => 'دمشق – البرامكة',  'addr' => 'دمشق، البرامكة — صالة عرض متخصصة',            'phone' => '+963 11 876 5432', 'top' => 64, 'left' => 15],
            ['name' => 'حلب – باب النصر',  'addr' => 'حلب، باب النصر — فرع المنطقة الشمالية',        'phone' => '+963 21 456 7890', 'top' => 28, 'left' => 28],
        ];
    @endphp
    <section id="branches" class="scroll-mt-24 py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">أينما كنت</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">فروعنا وصالات العرض</h2>
                <p class="text-[#4b4b4b] mt-3">نخدم عملاءنا في سوريا من خلال فروعنا وصالات العرض في دمشق وحلب.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="reveal order-2 lg:order-1">
                    <div class="relative w-full" style="aspect-ratio:659/600;">
                        <img src="{{ asset('images/syria-map.svg') }}" alt="خريطة سوريا" class="w-full h-full object-contain">
                        @foreach ($branches as $i => $b)
                            <div class="absolute -translate-x-1/2 -translate-y-full group"
                                 style="top:{{ $b['top'] }}%; left:{{ $b['left'] }}%;">
                                <span class="absolute left-1/2 -translate-x-1/2 bottom-1 w-4 h-4 rounded-full bg-brand anim-ping"></span>
                                <svg class="relative w-9 h-9 text-brand drop-shadow-lg anim-float" style="animation-delay:{{ $i*0.6 }}s" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2a7 7 0 0 0-7 7c0 5 7 13 7 13s7-8 7-13a7 7 0 0 0-7-7Z"/>
                                    <circle cx="12" cy="9" r="2.6" fill="#fff"/>
                                </svg>
                                <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1 whitespace-nowrap
                                             bg-[#141414] text-white text-[11px] font-bold rounded-md px-2 py-1 shadow-lg">{{ $b['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="order-1 lg:order-2 space-y-5">
                    @foreach ($branches as $i => $b)
                        <div class="reveal bg-white rounded-2xl shadow-md ring-1 ring-black/5 p-6 flex items-start gap-4
                                    hover:shadow-xl hover:-translate-y-0.5 transition-all" style="transition-delay:{{ $i*0.1 }}s">
                            <span class="shrink-0 w-12 h-12 rounded-xl bg-brand text-white grid place-items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                            </span>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-[#141414] mb-2">{{ $b['name'] }}</h3>
                                <p class="flex items-center gap-2 text-sm text-[#4b4b4b] mb-1">
                                    <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                                    {{ $b['addr'] }}
                                </p>
                                <a href="tel:{{ str_replace(' ', '', $b['phone']) }}" class="flex items-center gap-2 text-sm text-[#4b4b4b] hover:text-brand transition-colors">
                                    <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                                    <span dir="ltr">{{ $b['phone'] }}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ============ 11) CLIENTS — عملاؤنا ============ --}}
    @php
        $clients = [
            ['name' => 'Oxfam',                         'logo' => 'oxfam.png'],
            ['name' => 'UNRWA',                         'logo' => 'unrwa.jpg'],
            ['name' => 'الشركة السورية للبترول',        'logo' => 'spc.png'],
            ['name' => 'الشركة السورية للاتصالات',      'logo' => 'syriatel.jpg'],
            ['name' => 'الصندوق السيادي السوري',        'logo' => 'sovereign-fund.png'],
            ['name' => 'المؤسسة السورية للمخابز',       'logo' => 'bakeries.jpg'],
            ['name' => 'مؤسسة مياه درعا',              'logo' => 'daraa-water.jpg'],
        ];
    @endphp
    <section id="clients" class="scroll-mt-24 py-20 lg:py-28 bg-[#f7f7f8] relative overflow-hidden">
        {{-- خلفية منقّشة خفيفة --}}
        <div class="pointer-events-none absolute inset-0 opacity-[0.04]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-center">

                {{-- النص (يمين) --}}
                <div class="lg:col-span-4 text-right reveal">
                    <span class="inline-block text-brand font-bold text-sm mb-3">شركاء النجاح</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#141414] mb-4">عملاؤنا</h2>
                    <p class="text-[#4b4b4b] leading-loose">
                        يمكن لعملائنا الاعتماد علينا في أي وقت. تحرص شورى على تقديم منتجات عالية الجودة لكبرى المؤسسات الحكومية والدولية والخاصة.
                    </p>

                    {{-- مؤشرات الثقة --}}
                    <div class="flex items-center gap-8 mt-8">
                        <div>
                            <div class="text-3xl font-black text-brand leading-none">+45</div>
                            <div class="text-xs text-[#9a9a9a] mt-1.5">عاماً من الخبرة</div>
                        </div>
                        <span class="w-px h-10 bg-gray-200"></span>
                        <div>
                            <div class="text-3xl font-black text-brand leading-none">15+</div>
                            <div class="text-xs text-[#9a9a9a] mt-1.5">شراكة عالمية</div>
                        </div>
                    </div>

                    {{-- أسهم التنقّل --}}
                    <div class="flex items-center gap-3 mt-9">
                        <button id="clientsPrev" type="button" aria-label="السابق"
                                class="w-12 h-12 rounded-full bg-white ring-1 ring-black/5 shadow-sm grid place-items-center text-[#141414] hover:bg-brand hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </button>
                        <button id="clientsNext" type="button" aria-label="التالي"
                                class="w-12 h-12 rounded-full bg-white ring-1 ring-black/5 shadow-sm grid place-items-center text-[#141414] hover:bg-brand hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5l-7 7 7 7"/></svg>
                        </button>
                    </div>
                </div>

                {{-- شريط الشعارات (يسار) --}}
                <div class="lg:col-span-8 reveal">
                    <div id="clientsTrack" class="clients-track flex gap-5 pb-2" style="overflow-x:auto; scroll-behavior:smooth;">
                        @foreach ($clients as $c)
                            <div class="group shrink-0 w-40 sm:w-48 bg-white rounded-2xl ring-1 ring-black/5 shadow-sm
                                        hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <div class="relative h-32 flex items-center justify-center px-5">
                                    <img src="{{ asset('images/clients/'.$c['logo']) }}" alt="{{ $c['name'] }}"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                         style="max-height:4rem; max-width:80%; opacity:.85;"
                                         class="object-contain grayscale group-hover:grayscale-0 transition">
                                    <span style="display:none"
                                          class="absolute inset-0 items-center justify-center text-center px-3 font-black text-[15px] leading-snug text-[#4b4b4b] group-hover:text-brand transition-colors">{{ $c['name'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <style>
            .clients-track::-webkit-scrollbar { display: none; }
            .clients-track { -ms-overflow-style: none; scrollbar-width: none; }
        </style>
        <script>
            (function () {
                const track = document.getElementById('clientsTrack');
                if (!track) return;
                const step = 250;
                const prev = document.getElementById('clientsPrev');
                const next = document.getElementById('clientsNext');
                // في RTL نعكس اتجاه الأسهم لتطابق الشكل البصري
                if (prev) prev.addEventListener('click', () => track.scrollBy({ left: step, behavior: 'smooth' }));
                if (next) next.addEventListener('click', () => track.scrollBy({ left: -step, behavior: 'smooth' }));
            })();
        </script>
    </section>

@endsection
