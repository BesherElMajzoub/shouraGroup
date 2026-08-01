@extends('layouts.app')

@section('title', 'خدماتنا وحلولنا | شورى إخوان')
@section('description', 'الاستشارات الهندسية ودراسة المناقصات، عقود التسليم مفتاح، الصيانة وخدمات ما بعد البيع، وشبكة التوزيع وصالات العرض.')

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => 'خدماتنا وحلولنا',
        'eyebrow' => 'شريك هندسي متكامل',
        'title'   => 'حلول هندسية متكاملة لنجاح مشاريعكم',
        'desc'    => $services_intro,
    ])

    {{-- ===== DETAILED SERVICES ===== --}}
    <section class="py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 space-y-20 lg:space-y-28">
            @foreach ($services as $i => $s)
                @php $isEven = $i % 2 === 0; @endphp
                <div class="reveal grid lg:grid-cols-12 gap-10 lg:gap-16 items-center">
                    {{-- Content --}}
                    <div class="lg:col-span-7 space-y-6 order-2 {{ $isEven ? 'lg:order-1' : '' }} text-right">
                        <div class="flex items-center gap-4">
                            <span class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-brand-light text-brand shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="{{ $s->icon }}"/>
                                </svg>
                            </span>
                            <span class="text-5xl font-black text-brand/15 leading-none">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <h2 class="text-2xl sm:text-3xl font-black text-[#141414]">{{ $s->title }}</h2>
                        <p class="text-[#4b4b4b] leading-loose text-[15px]">{{ $s->description }}</p>

                        @if (is_array($s->features) && count($s->features))
                            <ul class="grid sm:grid-cols-2 gap-3 pt-3">
                                @foreach ($s->features as $feat)
                                    <li class="flex items-start gap-2.5 text-sm text-[#4b4b4b]">
                                        <svg class="w-4 h-4 text-brand shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="pt-4">
                            <a href="{{ url('/contact') }}?service={{ urlencode($s->title) }}&department={{ urlencode($s->dept) }}"
                               class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-6 py-2.5 rounded-lg font-bold text-sm transition-colors">
                                اطلب الخدمة الآن
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Image --}}
                    <div class="lg:col-span-5 order-1 {{ $isEven ? 'lg:order-2' : '' }}">
                        <div class="relative overflow-hidden rounded-[2rem] shadow-xl group">
                            <div class="absolute inset-0 bg-brand/10 opacity-0 group-hover:opacity-100 transition-opacity z-10"></div>
                            <img src="{{ $s->image_url }}" alt="{{ $s->title }}" class="w-full h-72 sm:h-96 object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                </div>
                @if (! $loop->last)
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
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414] mb-4">لماذا تختار شورى إخوان؟</h2>
                <p class="text-[#4b4b4b] leading-relaxed">
                    منذ عام 1978 ونحن الخيار الأول للمشاريع الاستراتيجية في السوق السورية، بخبرة تمتد لأكثر من أربعة عقود.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $benefits = [
                        ['title' => 'خبرة تمتد لأربعة عقود', 'desc' => 'منذ 1978 ونحن نبني الثقة مع القطاعين العام والخاص والمنظمات الدولية في سوريا.', 'icon' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
                        ['title' => 'وكالات عالمية معتمدة', 'desc' => 'ممثلون رسميون لنخبة من كبرى الشركات المصنعة، بضمان حقيقي وقطع غيار أصلية.', 'icon' => 'M9 12l2 2 4-4M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
                        ['title' => 'دقة في دفاتر الشروط', 'desc' => 'فريق هندسي متخصص في دراسة أعقد المناقصات الحكومية ومطابقة المواصفات الفنية.', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z'],
                        ['title' => 'دعم فني متواصل', 'desc' => 'مراكز صيانة وفرق فنية متنقلة للتدخل السريع وعقود صيانة دورية تضمن استمرارية عملكم.', 'icon' => 'M11.4 2.6a5 5 0 0 0 6 6L21 12l-2 2-3.4-3.4a5 5 0 0 1-6-6L7 1l4.4 1.6ZM3 17l6-6M3 17l3 3 6-6'],
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
            <p class="text-[#4b4b4b] mb-8 max-w-xl mx-auto">فريق شورى إخوان الهندسي جاهز لدراسة متطلبات مشروعك ودفتر الشروط الخاص به بكل دقة.</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-7 py-3 rounded-lg font-bold transition-colors">
                    تواصل معنا الآن
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
                <a href="{{ url('/sectors') }}" class="inline-flex items-center gap-2 border-2 border-[#141414] hover:bg-[#141414] hover:text-white text-[#141414] px-7 py-3 rounded-lg font-bold transition-colors">
                    تعرّف على قطاعاتنا
                </a>
            </div>
        </div>
    </section>

@endsection
