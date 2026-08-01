@extends('layouts.app')

@section('title', 'قطاعاتنا | شورى إخوان')
@section('description', 'قطاعات العمل المتكاملة في شورى إخوان: مضخات المياه، مجموعات التوليد، ضواغط الهواء، الغازات الطبية، والعدد الصناعية.')

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => 'قطاعاتنا',
        'eyebrow' => 'خبرة هندسية وتجارية متخصصة',
        'title'   => 'قطاعات العمل المتكاملة',
        'desc'    => $sectors_intro,
    ])

    {{-- ===== SECTORS GRID ===== --}}
    <section class="py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($sectors as $i => $s)
                    <article class="reveal group relative bg-white rounded-[1.75rem] overflow-hidden shadow-sm ring-1 ring-black/5
                                    {{ $s->is_coming_soon ? 'opacity-70' : 'hover:shadow-2xl hover:-translate-y-1.5' }} transition-all duration-300"
                             style="transition-delay:{{ $i * 0.07 }}s">

                        {{-- صورة / خلفية --}}
                        <div class="relative h-44 bg-[#141414] overflow-hidden">
                            <img src="{{ $s->image_url }}" alt="{{ $s->name }}"
                                 class="w-full h-full object-cover opacity-45 group-hover:opacity-60 group-hover:scale-105 transition-all duration-500">
                            <div class="absolute inset-0" style="background-image:linear-gradient(to top,#141414 5%,transparent 70%);"></div>

                            <span class="absolute top-5 right-5 w-14 h-14 rounded-2xl bg-brand text-white grid place-items-center shadow-lg shadow-black/30">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $s->icon }}"/></svg>
                            </span>

                            @if ($s->is_coming_soon)
                                <span class="absolute top-5 left-5 text-[11px] font-black text-[#141414] bg-white rounded-full px-3 py-1.5 shadow">قريباً</span>
                            @endif
                        </div>

                        <div class="p-7">
                            <h2 class="text-xl font-black text-[#141414] mb-2 leading-snug {{ $s->is_coming_soon ? '' : 'group-hover:text-brand' }} transition-colors">
                                {{ $s->name }}
                            </h2>
                            @if ($s->tagline)
                                <p class="text-xs font-bold text-brand mb-3">{{ $s->tagline }}</p>
                            @endif
                            <p class="text-[#4b4b4b] text-sm leading-relaxed mb-5">{{ Str::limit($s->intro, 150) }}</p>

                            @if ($s->is_coming_soon)
                                <span class="inline-flex items-center gap-1 text-[#9a9a9a] font-bold text-sm">قيد التأسيس</span>
                            @else
                                <a href="{{ route('sectors.show', $s->slug) }}"
                                   class="inline-flex items-center gap-1.5 text-brand font-bold text-sm group-hover:gap-3 transition-all">
                                    تفاصيل القطاع
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== CTA ===== --}}
    <section class="py-16 bg-[#141414] text-white relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.05]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 text-center">
            <h2 class="text-2xl sm:text-3xl font-black mb-4">لست متأكداً أي قطاع يناسب مشروعك؟</h2>
            <p class="text-white/70 mb-8 max-w-xl mx-auto">فريقنا الهندسي جاهز لدراسة متطلباتك واقتراح الحل الأنسب من بين قطاعاتنا ووكالاتنا العالمية.</p>
            <a href="{{ url('/contact') }}"
               class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                اطلب استشارة هندسية
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            </a>
        </div>
    </section>

@endsection
