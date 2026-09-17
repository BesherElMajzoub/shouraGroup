@extends('layouts.app')

@section('title', __('services_page.meta_title'))
@section('description', __('services_page.meta_description'))

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => __('ui.nav.services'),
        'eyebrow' => __('services_page.header.eyebrow'),
        'title'   => __('services_page.header.title'),
        'desc'    => $services_intro,
    ])

    {{-- ===== DETAILED SERVICES ===== --}}
    <section class="py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 space-y-20 lg:space-y-28">
            @foreach ($services as $i => $s)
                @php $isEven = $i % 2 === 0; @endphp
                <div class="reveal grid lg:grid-cols-12 gap-10 lg:gap-16 items-center">
                    {{-- Content --}}
                    <div class="lg:col-span-7 space-y-6 order-2 {{ $isEven ? 'lg:order-1' : '' }} text-start">
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
                            @if ($s->contact_whatsapp)
                                <a href="https://wa.me/{{ $s->contact_whatsapp }}?text={{ urlencode(__('services_page.whatsapp_message', ['service' => $s->title])) }}"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="{{ __('services_page.whatsapp_cta') }} - {{ $s->title }}"
                                   class="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white px-6 py-2.5 rounded-lg font-bold text-sm transition-colors shadow-lg shadow-[#25d366]/20">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.372-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.57-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.065 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.29.173-1.414-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.981.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.885-9.885 9.885m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.14 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                    {{ __('services_page.whatsapp_cta') }}
                                </a>
                            @endif
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
                <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('services_page.why_us.eyebrow') }}</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414] mb-4">{{ __('services_page.why_us.heading') }}</h2>
                <p class="text-[#4b4b4b] leading-relaxed">
                    {{ __('services_page.why_us.paragraph') }}
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $benefits = [
                        ['title' => __('services_page.benefits.experience.title'), 'desc' => __('services_page.benefits.experience.desc'), 'icon' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
                        ['title' => __('services_page.benefits.agencies.title'), 'desc' => __('services_page.benefits.agencies.desc'), 'icon' => 'M9 12l2 2 4-4M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
                        ['title' => __('services_page.benefits.tenders.title'), 'desc' => __('services_page.benefits.tenders.desc'), 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z'],
                        ['title' => __('services_page.benefits.support.title'), 'desc' => __('services_page.benefits.support.desc'), 'icon' => 'M11.4 2.6a5 5 0 0 0 6 6L21 12l-2 2-3.4-3.4a5 5 0 0 1-6-6L7 1l4.4 1.6ZM3 17l6-6M3 17l3 3 6-6'],
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
            <h2 class="text-2xl sm:text-3xl font-black text-[#141414] mb-4">{{ __('services_page.cta.heading') }}</h2>
            <p class="text-[#4b4b4b] mb-8 max-w-xl mx-auto">{{ __('services_page.cta.paragraph') }}</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/sectors') }}" class="inline-flex items-center gap-2 border-2 border-[#141414] hover:bg-[#141414] hover:text-white text-[#141414] px-7 py-3 rounded-lg font-bold transition-colors">
                    {{ __('services_page.cta.sectors_btn') }}
                </a>
            </div>
        </div>
    </section>

@endsection
