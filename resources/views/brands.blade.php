@extends('layouts.app')

@section('title', 'العلامات التجارية ووكالاتنا الرسمية | شورى إخوان')
@section('description', 'الوكالات العالمية المعتمدة لدى شورى إخوان: FORAS, PENTAX, STREAM, MARK, MMB, ESCO وغيرها من كبرى الشركات المصنعة.')

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => 'العلامات التجارية',
        'eyebrow' => 'وكلاء رسميون ومعتمدون',
        'title'   => 'وكالاتنا العالمية المعتمدة',
        'desc'    => $brands_intro,
    ])

    {{-- ===== OFFICIAL AGENCIES ===== --}}
    <section class="py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">شبكة الوكالات</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">وكالاتنا الرسمية</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($agencies as $i => $b)
                    <article id="{{ $b->slug }}"
                             class="reveal scroll-mt-28 group relative bg-white rounded-[1.75rem] overflow-hidden
                                    shadow-sm ring-1 ring-black/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300"
                             style="transition-delay:{{ $i * 0.07 }}s">

                        <span class="absolute top-5 left-5 z-10 text-[10px] font-black text-white bg-brand rounded-full px-3 py-1.5 shadow">وكالة رسمية</span>

                        <div class="h-36 bg-[#f7f7f8] grid place-items-center px-8 border-b border-gray-100">
                            @if ($b->logo_url)
                                <img src="{{ $b->logo_url }}" alt="{{ $b->name }}"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                     class="max-h-20 max-w-[70%] object-contain group-hover:scale-105 transition-transform duration-300">
                                <span style="display:none" class="font-black text-2xl text-[#141414]">{{ $b->name }}</span>
                            @else
                                <span class="font-black text-2xl text-[#141414] group-hover:text-brand transition-colors">{{ $b->name }}</span>
                            @endif
                        </div>

                        <div class="p-7">
                            <div class="flex items-center gap-2 mb-3">
                                <h3 class="text-xl font-black text-[#141414]">{{ $b->name }}</h3>
                                @if ($b->country)
                                    <span class="text-xs font-bold text-brand bg-brand-light rounded-full px-3 py-1">{{ $b->country }}</span>
                                @endif
                            </div>
                            <p class="text-xs font-bold text-[#9a9a9a] mb-2">مجال المنتجات</p>
                            <p class="text-[#4b4b4b] text-sm leading-relaxed">{{ $b->description }}</p>

                            @if ($b->sectors->isNotEmpty())
                                <div class="flex flex-wrap gap-2 mt-5 pt-5 border-t border-gray-100">
                                    @foreach ($b->sectors as $s)
                                        <a href="{{ route('sectors.show', $s->slug) }}"
                                           class="text-[11px] font-bold text-[#4b4b4b] bg-[#f7f7f8] hover:bg-brand hover:text-white rounded-full px-3 py-1.5 transition-colors">
                                            {{ $s->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== ALL BRANDS ===== --}}
    <section class="py-20 lg:py-28 bg-[#f7f7f8] relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.03]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">كل الشركاء</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414] mb-4">العلامات التجارية التي نمثّلها</h2>
                <p class="text-[#4b4b4b] leading-relaxed">تشكيلة كاملة من العلامات العالمية التي نوفّرها عبر قطاعاتنا الخمسة وصالات العرض في دمشق وحلب.</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach ($brands as $i => $b)
                    {{-- الوكالات الرسمية تملك مرساتها في القسم الأعلى، فلا نكرّر المعرّف هنا --}}
                    <div @unless ($b->is_agency) id="{{ $b->slug }}" @endunless
                         class="reveal scroll-mt-28 group bg-white rounded-2xl p-5 shadow-sm ring-1 ring-black/5
                                hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                         style="transition-delay:{{ ($i % 8) * 0.05 }}s">
                        <div class="h-20 flex items-center justify-center mb-4">
                            @if ($b->logo_url)
                                <img src="{{ $b->logo_url }}" alt="{{ $b->name }}"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                     class="max-h-14 max-w-[80%] object-contain grayscale group-hover:grayscale-0 transition">
                                <span style="display:none" class="font-black text-lg text-[#4b4b4b] group-hover:text-brand transition-colors">{{ $b->name }}</span>
                            @else
                                <span class="font-black text-lg text-[#4b4b4b] group-hover:text-brand transition-colors text-center">{{ $b->name }}</span>
                            @endif
                        </div>
                        <h3 class="text-sm font-bold text-[#141414] text-center leading-snug">{{ $b->name }}</h3>
                        @if ($b->country)
                            <p class="text-[11px] text-[#9a9a9a] text-center mt-1">{{ $b->country }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== CTA ===== --}}
    <section class="py-16 bg-[#141414] text-white relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.05]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 text-center">
            <h2 class="text-2xl sm:text-3xl font-black mb-4">تبحث عن علامة تجارية بعينها؟</h2>
            <p class="text-white/70 mb-8 max-w-xl mx-auto">تواصل معنا لمعرفة توفّر الموديلات والمواصفات الفنية وقطع الغيار الأصلية لأي من وكالاتنا.</p>
            <a href="{{ url('/contact') }}"
               class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                استفسر عن وكالة
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            </a>
        </div>
    </section>

@endsection
