@extends('layouts.app')

@section('title', 'قصة شورى | مجموعة شورى')
@section('description', 'قصة مجموعة شورى — مسيرة من النمو والريادة في مجال المياه والمسابح والمقاولات في سوريا.')

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => 'قصتنا',
        'eyebrow' => 'مسيرتنا منذ الانطلاقة',
        'title'   => 'قصة شورى',
        'desc'    => 'من فكرة طموحة إلى مجموعة شركات رائدة؛ هذه رحلة شورى في بناء الثقة وتقديم الحلول المتكاملة لخدمة سوريا وأهلها.',
    ])

    {{-- ===== OVERVIEW ===== --}}
    <section class="py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">نظرة عامة</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414] mb-6">كيف بدأت الحكاية</h2>
                <div class="space-y-4 text-[#4b4b4b] leading-loose text-[15px]">
                    @foreach (explode("\n\n", $story_overview_body) as $para)
                        <p>{{ $para }}</p>
                    @endforeach
                </div>
            </div>

            <div class="reveal" style="transition-delay:.15s">
                <div class="relative">
                    <div class="absolute -inset-3 rounded-[2rem] bg-brand/10 blur-2xl"></div>
                    <img src="{{ str_starts_with($story_overview_image, 'images/') ? asset($story_overview_image) : asset('storage/' . $story_overview_image) }}" alt="مجموعة شورى"
                         class="relative w-full h-[360px] lg:h-[440px] object-cover rounded-[2rem] shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    {{-- ===== TIMELINE ===== --}}
    <section class="py-20 lg:py-28 bg-[#f7f7f8] relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.03]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">محطات في الطريق</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">خط زمن المجموعة</h2>
            </div>

            <div class="relative max-w-5xl mx-auto">
                <div class="absolute top-2 bottom-2 right-5 lg:right-1/2 lg:translate-x-1/2 w-1 bg-brand/25 rounded-full"></div>

                @foreach ($timeline_nodes as $i => $s)
                    @php $right = $i % 2 === 0; @endphp
                    <div class="reveal relative grid grid-cols-1 lg:grid-cols-2 items-center gap-y-3 lg:gap-x-14 mb-10 lg:mb-4 pr-14 lg:pr-0">
                        <div class="absolute right-[14px] lg:right-1/2 lg:translate-x-1/2 -translate-y-1/2 top-1/2
                                    w-4 h-4 rounded-full bg-brand ring-4 ring-[#f7f7f8] z-10"></div>

                        <div class="flex {{ $right ? 'lg:justify-end lg:order-1' : 'lg:justify-start lg:order-2' }}">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full grid place-items-center text-white font-black text-xl shadow-lg
                                        {{ $right ? 'bg-brand shadow-brand/30' : 'bg-[#141414]' }}">
                                {{ $s->event_date }}
                            </div>
                        </div>

                        <div class="{{ $right ? 'lg:order-2' : 'lg:order-1' }}">
                            <div class="relative bg-white rounded-2xl shadow-md ring-1 ring-black/5 p-6 text-right hover:shadow-xl transition-shadow">
                                <span class="hidden lg:block absolute top-1/2 -translate-y-1/2 w-3 h-3 rotate-45 bg-white"
                                      style="{{ $right ? 'right:-6px' : 'left:-6px' }}"></span>
                                <h3 class="text-lg font-bold text-brand mb-2">{{ $s->title }}</h3>
                                <p class="text-[#4b4b4b] text-sm leading-relaxed">{{ $s->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== VALUES ===== --}}
    @php
        $values = [
            ['title' => 'الجودة', 'desc' => 'نلتزم بأعلى المعايير في كل تفصيل من عملنا.', 'icon' => 'M9 12l2 2 4-4M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
            ['title' => 'الثقة', 'desc' => 'نبني علاقات طويلة الأمد قائمة على الصدق والوفاء.', 'icon' => 'M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z'],
            ['title' => 'الاحترافية', 'desc' => 'فريق مؤهّل يعمل بانضباط والتزام بالمواعيد.', 'icon' => 'M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0ZM4 21v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6v1'],
            ['title' => 'الاستدامة', 'desc' => 'نمو مسؤول يراعي البيئة ومستقبل المجتمع.', 'icon' => 'M12 3c-3.5 4-6 7.2-6 10.5a6 6 0 0 0 12 0C18 10.2 15.5 7 12 3Z'],
        ];
    @endphp
    <section class="py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">ما يحرّكنا</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">قيمنا</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($values as $i => $v)
                    <div class="reveal text-center bg-[#f7f7f8] rounded-2xl p-8 hover:shadow-xl hover:-translate-y-1 transition-all"
                         style="transition-delay:{{ $i*0.08 }}s">
                        <div class="w-16 h-16 mx-auto rounded-2xl bg-brand text-white grid place-items-center mb-5">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $v['icon'] }}"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-[#141414] mb-2">{{ $v['title'] }}</h3>
                        <p class="text-[#4b4b4b] text-sm leading-relaxed">{{ $v['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== STATS ===== --}}
    <section class="py-16 bg-[#141414] text-white relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.05]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            @foreach ($stats->whereIn('id', [4, 5, 3, 6]) as $stat)
                @if($stat)
                    <div class="reveal">
                        <div class="text-4xl sm:text-5xl font-black text-brand mb-2">{{ $stat->value }}</div>
                        <div class="text-white/70 text-sm">{{ $stat->label }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- ===== CTA ===== --}}
    <section class="py-20 bg-white">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 text-center reveal">
            <h2 class="text-2xl sm:text-3xl font-black text-[#141414] mb-4">هل تريد أن تكون جزءاً من قصتنا القادمة؟</h2>
            <p class="text-[#4b4b4b] mb-8">تواصل مع فريق مجموعة شورى لنبدأ مشروعك القادم معاً.</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/') }}#contact" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-7 py-3 rounded-lg font-bold transition-colors">
                    تواصل معنا
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
                <a href="{{ url('/') }}#companies" class="inline-flex items-center gap-2 border-2 border-[#141414] hover:bg-[#141414] hover:text-white text-[#141414] px-7 py-3 rounded-lg font-bold transition-colors">
                    تعرّف على شركاتنا
                </a>
            </div>
        </div>
    </section>

@endsection
