@extends('layouts.app')

@section('title', 'شورى إخوان | التوريدات الهندسية في سوريا منذ 1978')

@section('content')

    {{-- ============ HERO ============ --}}
    @php
        $chips = [
            ['label' => 'مجموعات التوليد',   'top' => 6,  'left' => 10, 'size' => 6,   'r' => -8, 'd' => 0.0,
                'image' => 'images/hero/Shora Generators Services.PNG'],
            ['label' => 'مضخات المياه',      'top' => 14, 'left' => 78, 'size' => 6.5, 'r' => 6,  'd' => 0.6,
                'image' => 'images/hero/Shora Water pumps.PNG'],
            ['label' => 'ضواغط الهواء',      'top' => 2,  'left' => 44, 'size' => 5.5, 'r' => 4,  'd' => 1.2,
                'image' => 'images/hero/compressors.png'],
            ['label' => 'غازات طبية',        'top' => 40, 'left' => 4,  'size' => 5.5, 'r' => 10, 'd' => 0.3,
                'image' => 'images/hero/shora_medical.png'],
            ['label' => 'تجهيزات كهربائية',  'top' => 46, 'left' => 88, 'size' => 5,   'r' => -6, 'd' => 0.9,
                'image' => 'images/brands/bbc.svg'],
            ['label' => 'عُدد صناعية',       'top' => 70, 'left' => 14, 'size' => 4.5, 'r' => -12,'d' => 1.5,
                'image' => 'images/brands/keyang.svg'],
            ['label' => 'تطوير عقاري',       'top' => 76, 'left' => 70, 'size' => 5,   'r' => 8,  'd' => 0.4,
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M5.25 21V7.5l6.75-4.5 6.75 4.5V21M9.75 21v-5.25h4.5V21M9.75 11.25h.008M14.25 11.25h.008M9.75 14.25h.008M14.25 14.25h.008"/>'],
            ['label' => 'وكالات عالمية',      'top' => 24, 'left' => 26, 'size' => 5,   'r' => 12, 'd' => 1.1,
                'image' => 'images/brands/FPT_Logo_Red.png'],
            ['label' => 'منذ عام 1978',      'top' => 30, 'left' => 62, 'size' => 5,   'r' => -10,'d' => 0.7,
                'image' => 'images/hero/Shora Group Logo Offical Without BG.png'],
        ];
    @endphp
    <section id="hero" class="relative overflow-hidden bg-gradient-to-b from-brand-light/60 to-white scroll-mt-24">
        <div class="pointer-events-none absolute inset-0 opacity-[0.04]"
             style="background-image:radial-gradient(#141414 1px, transparent 1px); background-size:22px 22px;"></div>

        <div class="hidden lg:block absolute inset-0 pointer-events-none">
            @foreach ($chips as $c)
                <div class="absolute anim-float pointer-events-auto"
                     style="top:{{ $c['top'] }}%; left:{{ $c['left'] }}%; --r:{{ $c['r'] }}deg;
                            width:{{ $c['size'] }}rem; height:{{ $c['size'] }}rem;
                            animation-delay:{{ $c['d'] }}s; transform:rotate({{ $c['r'] }}deg);">
                    <div class="w-full h-full rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-3.5 grid place-items-center
                                opacity-90 hover:opacity-100 hover:scale-110 hover:shadow-2xl transition-all duration-300">
                        @if (!empty($c['image']))
                            <img src="{{ asset($c['image']) }}" alt="{{ $c['label'] }}"
                                 class="max-h-full max-w-full object-contain">
                        @else
                            <span class="grid place-items-center w-full h-full rounded-full bg-brand-light text-brand">
                                <svg class="w-2/3 h-2/3" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">{!! $c['icon'] !!}</svg>
                            </span>
                        @endif
                    </div>
                    <span class="block mt-1.5 text-center text-[11px] font-extrabold text-[#141414]/70 bg-white/80 backdrop-blur-sm rounded-full px-2 py-0.5 shadow-sm mx-auto w-fit">{{ $c['label'] }}</span>
                </div>
            @endforeach
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 py-16 lg:py-28">
            <div class="flex flex-col items-center text-center">
                <div class="relative mb-8 anim-pop">
                    <div class="absolute -inset-8 rounded-full bg-brand/20 blur-3xl anim-glow"></div>
                    <img src="{{ asset('images/hero/Shora Group Logo Offical Without BG.png') }}" alt="شورى إخوان"
                         class="relative h-28 sm:h-40 w-auto drop-shadow-sm anim-float">
                </div>

                <h1 class="text-3xl sm:text-5xl font-black text-[#141414] leading-tight anim-fade-up" style="animation-delay:.15s">
                    شورى <span class="text-brand">إخوان</span>
                </h1>
                <p class="mt-4 max-w-2xl text-base sm:text-lg text-[#4b4b4b] leading-relaxed anim-fade-up" style="animation-delay:.3s">
                    الشركة الرائدة في التوريدات الهندسية في سوريا منذ عام 1978 — حلول متكاملة في توليد الكهرباء، ضخ المياه، ضواغط الهواء، الغازات الطبية، والتجهيزات الكهربائية.
                </p>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-4 anim-fade-up" style="animation-delay:.45s">
                    <a href="{{ url('/sectors') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-7 py-3 rounded-lg font-bold transition-colors">
                        تصفّح قطاعاتنا
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                    </a>
                    <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 border-2 border-[#141414] hover:bg-[#141414] hover:text-white text-[#141414] px-7 py-3 rounded-lg font-bold transition-colors">
                        تواصل معنا
                    </a>
                </div>
            </div>

            <div class="lg:hidden flex flex-wrap items-center justify-center gap-3 mt-12">
                @foreach ($chips as $c)
                    <div class="flex items-center gap-2 bg-white rounded-xl shadow-sm ring-1 ring-black/5 px-3 py-2">
                        @if (!empty($c['image']))
                            <img src="{{ asset($c['image']) }}" alt="{{ $c['label'] }}" class="w-7 h-7 object-contain">
                        @else
                            <span class="grid place-items-center w-7 h-7 rounded-full bg-brand-light text-brand">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">{!! $c['icon'] !!}</svg>
                            </span>
                        @endif
                        <span class="text-xs font-bold text-[#141414]/70">{{ $c['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ ABOUT — من نحن ============ --}}
    <section id="about" class="scroll-mt-24 py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">من نحن</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414] mb-4">{{ $about_subtitle }}</h2>
                <div class="space-y-4 text-[#4b4b4b] leading-loose text-[15px]">
                    @foreach (explode("\n\n", $about_body) as $para)
                        <p>{{ $para }}</p>
                    @endforeach
                </div>
                <div class="mt-8 grid grid-cols-3 gap-4 max-w-md">
                    @foreach ($stats->take(3) as $stat)
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-black text-brand">{{ $stat->value }}</div>
                            <div class="text-xs text-[#4b4b4b] mt-1">{{ $stat->label }}</div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ url('/about') }}" class="inline-flex items-center gap-2 mt-8 text-brand font-bold hover:gap-3 transition-all">
                    اقرأ قصة شورى إخوان كاملة
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
            </div>

            <div class="reveal" style="transition-delay:.15s">
                <div class="grid grid-cols-2 gap-4">
                    <img src="{{ asset('images/about_skyscrapers.png') }}" alt="" class="col-span-2 w-full h-56 object-cover rounded-2xl shadow-lg">
                    <img src="{{ asset('images/industrial_bg.png') }}" alt="" class="w-full h-40 object-cover rounded-2xl shadow-lg">
                    <div class="w-full h-40 rounded-2xl bg-brand grid place-items-center shadow-lg">
                        <img src="{{ asset('images/shora-logo.svg') }}" alt="شورى إخوان" class="h-16 w-auto brightness-0 invert">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ VISION & MISSION — الرؤية والرسالة ============ --}}
    <section id="vision" class="scroll-mt-24 relative overflow-hidden bg-white">
        <div class="pointer-events-none absolute inset-0 opacity-[0.04]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="hidden lg:block absolute inset-y-0 left-0 w-[55%]">
            <img src="{{ asset('images/shora-building.jpg') }}" alt="مبنى شورى إخوان"
                 class="w-full h-full object-cover"
                 style="-webkit-mask-image:linear-gradient(to right,#000 45%,transparent 92%); mask-image:linear-gradient(to right,#000 45%,transparent 92%);">
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 py-16 lg:py-28">
            <div class="lg:hidden mb-10 reveal">
                <img src="{{ asset('images/shora-building.jpg') }}" alt="مبنى شورى إخوان"
                     class="w-full h-56 object-cover rounded-3xl shadow-xl">
            </div>

            <div class="lg:w-[46%] space-y-14">
                <div class="reveal flex items-start gap-7">
                    <div class="flex-1 pt-2">
                        <h3 class="text-3xl font-black text-[#141414] mb-4">الرؤية</h3>
                        <p class="text-[#4b4b4b] leading-loose text-[15px]">{{ $vision_text }}</p>
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
                        <p class="text-[#4b4b4b] leading-loose text-[15px]">{{ $mission_text }}</p>
                    </div>
                    <div class="relative shrink-0 anim-float" style="animation-delay:1s">
                        <div class="w-24 h-24 rounded-full grid place-items-center shadow-xl text-white"
                             style="background-image:linear-gradient(145deg,#2a2a2a,#141414);">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 15 9l7 .5-5.5 4.5L18 21l-6-3.5L6 21l1.5-7L2 9.5 9 9l3-7Z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ SECTORS — قطاعاتنا ============ --}}
    @php
        $rightSectors = $sectors->slice(0, ceil($sectors->count() / 2));
        $leftSectors  = $sectors->slice(ceil($sectors->count() / 2));
    @endphp
    <section id="sectors" class="scroll-mt-24 py-20 lg:py-28 bg-[#f7f7f8] relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.03]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">مجالات عملنا</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">قطاعاتنا</h2>
            </div>

            <div class="grid lg:grid-cols-3 gap-6 lg:gap-8 items-center">
                {{-- بطاقات اليمين --}}
                <div class="space-y-5 order-2 lg:order-1">
                    @foreach ($rightSectors as $i => $s)
                        @include('partials.sector-card', ['s' => $s, 'i' => $i, 'align' => 'right'])
                    @endforeach
                </div>

                {{-- الدائرة المركزية --}}
                <div class="order-1 lg:order-2 reveal">
                    <div class="relative w-72 h-72 sm:w-80 sm:h-80 mx-auto">
                        <div class="absolute -inset-3 rounded-full border-2 border-dashed border-brand/25"></div>
                        <div class="absolute inset-0 rounded-full bg-white shadow-2xl ring-1 ring-black/5 grid place-items-center">
                            <div class="text-center px-8">
                                <div class="text-sm font-bold text-[#4b4b4b] mb-1">منذ عام</div>
                                <div class="text-6xl font-black text-brand leading-none mb-4">1978</div>
                                <img src="{{ asset('images/shora-logo.svg') }}" alt="شورى إخوان" class="h-14 w-auto mx-auto">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- بطاقات اليسار --}}
                <div class="space-y-5 order-3">
                    @foreach ($leftSectors as $i => $s)
                        @include('partials.sector-card', ['s' => $s, 'i' => $i, 'align' => 'left'])
                    @endforeach
                </div>
            </div>

            <div class="text-center mt-12 reveal">
                <a href="{{ url('/sectors') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-7 py-3 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                    تفاصيل كل القطاعات
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ============ SERVICES — الخدمات والحلول ============ --}}
    <section id="services" class="scroll-mt-24 py-20 lg:py-28 bg-white">
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
                                <path d="{{ $s->icon }}"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-[#141414] mb-2 leading-snug">{{ $s->title }}</h3>
                        <p class="text-[#4b4b4b] text-sm leading-relaxed">{{ $s->description }}</p>
                        <a href="{{ url('/contact') }}?service={{ urlencode($s->title) }}&department={{ urlencode($s->dept) }}"
                           class="inline-flex items-center gap-1 mt-4 text-brand font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity">
                            اطلب الخدمة
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12 reveal">
                <a href="{{ url('/services') }}" class="inline-flex items-center gap-2 text-brand font-bold hover:gap-3 transition-all">
                    كل خدماتنا وحلولنا الهندسية
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ============ PARTNERS — شركاؤنا ============ --}}
    <section id="partners" class="scroll-mt-24 py-20 lg:py-28 bg-[#141414] text-white relative overflow-hidden">
        <img src="{{ asset('images/shora-logo.svg') }}" alt=""
             class="pointer-events-none absolute -left-20 -bottom-16 w-[30rem] opacity-[0.04] brightness-0 invert">

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 grid lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            <div class="lg:col-span-4 text-right reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">تكنولوجيا بضمان وموثوقية</span>
                <h2 class="text-3xl sm:text-4xl font-black mb-4">شركاؤنا</h2>
                <p class="text-white/70 leading-loose">{{ $partners_intro }}</p>
                <a href="{{ url('/brands') }}" class="inline-flex items-center gap-2 mt-8 bg-brand hover:bg-brand-dark text-white px-6 py-3 rounded-xl font-bold text-sm transition-colors">
                    وكالاتنا الرسمية
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
            </div>

            <div class="lg:col-span-8 reveal">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($brands as $b)
                        <a href="{{ url('/brands') }}#{{ $b->slug }}"
                           class="group h-24 rounded-2xl bg-white shadow-md ring-1 ring-black/5 hover:shadow-xl hover:-translate-y-1 hover:scale-[1.02]
                                  grid place-items-center px-4 transition-all duration-300" title="{{ $b->name }}">
                            @if ($b->logo_url)
                                <img src="{{ $b->logo_url }}" alt="{{ $b->name }}"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                     class="max-h-12 max-w-[82%] object-contain opacity-90 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300">
                                <span style="display:none" class="items-center justify-center text-center font-black text-sm text-[#141414] group-hover:text-brand transition-colors">{{ $b->name }}</span>
                            @else
                                <span class="flex items-center justify-center text-center font-black text-sm text-[#141414] group-hover:text-brand transition-colors">{{ $b->name }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ============ CLIENTS — عملاؤنا ============ --}}
    <section id="clients" class="scroll-mt-24 py-20 lg:py-28 bg-white relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.04]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                <div class="lg:col-span-4 text-right reveal">
                    <span class="inline-block text-brand font-bold text-sm mb-3">ثقة تتجدد</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#141414] mb-4">عملاؤنا</h2>
                    <p class="text-[#4b4b4b] leading-loose">{{ $clients_intro }}</p>

                    <div class="flex items-center gap-8 mt-8">
                        @foreach ($stats->take(2) as $stat)
                            <div>
                                <div class="text-3xl font-black text-brand leading-none">{{ $stat->value }}</div>
                                <div class="text-xs text-[#9a9a9a] mt-1.5">{{ $stat->label }}</div>
                            </div>
                            @if (!$loop->last)
                                <span class="w-px h-10 bg-gray-200"></span>
                            @endif
                        @endforeach
                    </div>

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

                <div class="lg:col-span-8 reveal">
                    <div id="clientsTrack" class="clients-track flex gap-5 pb-2" style="overflow-x:auto; scroll-behavior:smooth;">
                        @foreach ($clients->concat($clients) as $c)
                            <div class="group shrink-0 w-40 sm:w-48 bg-white rounded-2xl ring-1 ring-black/5 shadow-sm
                                        hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <div class="relative h-32 flex items-center justify-center px-5">
                                    @if ($c->logo_url)
                                        <img src="{{ $c->logo_url }}" alt="{{ $c->name }}"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                             style="max-height:4rem; max-width:80%; opacity:.85;"
                                             class="object-contain grayscale group-hover:grayscale-0 transition">
                                        <span style="display:none"
                                              class="absolute inset-0 items-center justify-center text-center px-3 font-black text-[15px] leading-snug text-[#4b4b4b] group-hover:text-brand transition-colors">{{ $c->name }}</span>
                                    @else
                                        <span class="flex items-center justify-center text-center px-3 font-black text-[15px] leading-snug text-[#4b4b4b] group-hover:text-brand transition-colors">{{ $c->name }}</span>
                                    @endif
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
    </section>

    {{-- ============ BRANCHES — فروعنا وصالات العرض ============ --}}
    <section id="branches" class="scroll-mt-24 py-20 lg:py-28 bg-[#f7f7f8]">
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
                                 style="top:{{ $b->map_top }}%; left:{{ $b->map_left }}%;">
                                <span class="absolute left-1/2 -translate-x-1/2 bottom-1 w-4 h-4 rounded-full bg-brand anim-ping"></span>
                                <svg class="relative w-9 h-9 text-brand drop-shadow-lg anim-float" style="animation-delay:{{ $i*0.6 }}s" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2a7 7 0 0 0-7 7c0 5 7 13 7 13s7-8 7-13a7 7 0 0 0-7-7Z"/>
                                    <circle cx="12" cy="9" r="2.6" fill="#fff"/>
                                </svg>
                                <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1 whitespace-nowrap
                                             bg-[#141414] text-white text-[11px] font-bold rounded-md px-2 py-1 shadow-lg">{{ $b->name }}</span>
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
                                <h3 class="text-lg font-bold text-[#141414] mb-1">{{ $b->name }}</h3>
                                <p class="text-sm text-brand font-bold mb-2">{{ $b->description }}</p>
                                <p class="flex items-center gap-2 text-sm text-[#4b4b4b] mb-1">
                                    <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                                    {{ $b->address }}
                                </p>
                                @if ($b->phone)
                                    <a href="tel:{{ preg_replace('/\s/', '', $b->phone) }}" class="flex items-center gap-2 text-sm text-[#4b4b4b] hover:text-brand transition-colors">
                                        <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                                        <span dir="ltr">{{ $b->phone }}</span>
                                        @if ($b->mobile)
                                            <span class="text-[#9a9a9a]">/</span>
                                            <span dir="ltr">{{ $b->mobile }}</span>
                                        @endif
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ============ NEWS — الأخبار ============ --}}
    <section id="news" class="scroll-mt-24 py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="flex items-end justify-between gap-4 mb-12 reveal">
                <div>
                    <span class="inline-block text-brand font-bold text-sm mb-3">آخر المستجدّات</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">الأخبار</h2>
                </div>
                <a href="{{ route('news') }}" class="hidden sm:inline-flex items-center gap-2 text-brand font-bold text-sm hover:gap-3 transition-all">
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
                            <img src="{{ $n->image_url }}" alt="{{ $n->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 right-4 bg-brand text-white text-xs font-bold rounded-full px-3 py-1">{{ $n->category->name }}</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-[#9a9a9a] mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                {{ $n->published_at ? $n->published_at->translatedFormat('j F Y') : '' }}
                            </div>
                            <h3 class="text-lg font-bold text-[#141414] mb-2 leading-snug group-hover:text-brand transition-colors">{{ $n->title }}</h3>
                            <p class="text-[#4b4b4b] text-sm leading-relaxed mb-4">{{ $n->excerpt }}</p>
                            <a href="{{ route('news.show', $n->slug) }}" class="inline-flex items-center gap-1 text-brand font-bold text-sm">
                                اقرأ التفاصيل
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    (function () {
        const track = document.getElementById('clientsTrack');
        if (!track) return;

        let isHovered = false;
        let animId = null;
        const speed = 0.8;

        function autoScroll() {
            if (!isHovered) {
                // In RTL mode, scrollLeft can be negative or decreasing
                const maxScroll = (track.scrollWidth / 2);
                if (Math.abs(track.scrollLeft) >= maxScroll - 5) {
                    track.scrollLeft = 0;
                } else {
                    track.scrollLeft -= speed;
                }
            }
            animId = requestAnimationFrame(autoScroll);
        }

        track.addEventListener('mouseenter', () => { isHovered = true; });
        track.addEventListener('mouseleave', () => { isHovered = false; });
        track.addEventListener('touchstart', () => { isHovered = true; }, { passive: true });
        track.addEventListener('touchend', () => { isHovered = false; }, { passive: true });

        const manualStep = 240;
        document.getElementById('clientsPrev')?.addEventListener('click', () => {
            track.scrollBy({ left: manualStep, behavior: 'smooth' });
        });
        document.getElementById('clientsNext')?.addEventListener('click', () => {
            track.scrollBy({ left: -manualStep, behavior: 'smooth' });
        });

        animId = requestAnimationFrame(autoScroll);
    })();
</script>
@endpush
