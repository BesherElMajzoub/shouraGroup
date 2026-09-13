@extends('layouts.app')

@section('title', $sector->name . ' | ' . __('ui.company.name'))
@section('description', Str::limit($sector->intro, 160))

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => $sector->name,
        'parent'  => ['label' => __('ui.nav.sectors'), 'href' => url('/sectors')],
        'eyebrow' => $sector->tagline ?: __('sectors_show.default_eyebrow'),
        'title'   => $sector->name,
        'desc'    => $sector->intro,
    ])

    {{-- ===== SPECIALTIES & EQUIPMENT ===== --}}
    <section class="py-20 lg:py-28 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 grid lg:grid-cols-12 gap-12 lg:gap-16 items-start">

            <div class="lg:col-span-7 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('sectors_show.specialties.eyebrow') }}</span>
                <h2 class="text-2xl sm:text-3xl font-black text-[#141414] mb-8">{{ __('sectors_show.specialties.heading') }}</h2>

                <div class="space-y-4">
                    @forelse ($sector->specialties ?? [] as $i => $item)
                        <div class="flex items-start gap-4 p-5 rounded-2xl bg-[#f7f7f8] ring-1 ring-black/5
                                    hover:bg-white hover:shadow-lg transition-all">
                            <span class="shrink-0 w-9 h-9 rounded-xl bg-brand text-white grid place-items-center font-black text-sm">
                                {{ $i + 1 }}
                            </span>
                            <p class="flex-1 text-[15px] text-[#141414] font-medium leading-relaxed pt-1.5">{{ $item }}</p>
                        </div>
                    @empty
                        <p class="text-[#9a9a9a]">{{ __('sectors_show.specialties.empty') }}</p>
                    @endforelse
                </div>

                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ url('/contact') }}?subject={{ urlencode(__('sectors_show.inquiry_subject_prefix') . $sector->name) }}"
                       class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-7 py-3 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                        {{ __('sectors_show.quote_btn') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                    </a>
                    <a href="{{ url('/wholesale') }}"
                       class="inline-flex items-center gap-2 border-2 border-[#141414] hover:bg-[#141414] hover:text-white text-[#141414] px-7 py-3 rounded-xl font-bold text-sm transition-colors">
                        {{ __('sectors_show.wholesale_btn') }}
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5 reveal" style="transition-delay:.15s">
                <div class="relative">
                    <div class="absolute -inset-3 rounded-[2rem] bg-brand/10 blur-2xl"></div>
                    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl bg-[#141414]">
                        <img src="{{ $sector->image_url }}" alt="{{ $sector->name }}"
                             class="w-full h-72 lg:h-96 object-cover opacity-80">
                        <div class="absolute bottom-0 inset-x-0 p-6" style="background-image:linear-gradient(to top,#141414,transparent);">
                            <span class="inline-flex items-center gap-2.5 text-white font-bold">
                                <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $sector->icon }}"/></svg>
                                {{ $sector->name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== SECTOR BRANDS ===== --}}
    @if ($sector->brands->isNotEmpty())
        <section class="py-20 lg:py-28 bg-[#f7f7f8] relative overflow-hidden">
            <div class="pointer-events-none absolute inset-0 opacity-[0.03]"
                 style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

            <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
                <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                    <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('sectors_show.brands.eyebrow') }}</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">{{ __('sectors_show.brands.heading') }}</h2>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($sector->brands as $i => $b)
                        <div class="reveal bg-white rounded-2xl p-6 shadow-sm ring-1 ring-black/5 hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                             style="transition-delay:{{ $i * 0.06 }}s">
                            <div class="h-20 flex items-center justify-center mb-5">
                                @if ($b->logo_url)
                                    <img src="{{ $b->logo_url }}" alt="{{ $b->name }}"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                         class="max-h-16 max-w-[75%] object-contain">
                                    <span style="display:none" class="font-black text-xl text-[#141414]">{{ $b->name }}</span>
                                @else
                                    <span class="font-black text-xl text-[#141414]">{{ $b->name }}</span>
                                @endif
                            </div>
                            <div class="text-center">
                                <h3 class="font-bold text-[#141414]">{{ $b->name }}</h3>
                                @if ($b->country)
                                    <span class="inline-block text-xs font-bold text-brand bg-brand-light rounded-full px-3 py-1 mt-2">{{ $b->country }}</span>
                                @endif
                                @if ($b->is_agency)
                                    <span class="inline-block text-xs font-bold text-white bg-[#141414] rounded-full px-3 py-1 mt-2 mr-1">{{ __('sectors_show.brands.official_badge') }}</span>
                                @endif
                                <p class="text-[#4b4b4b] text-sm leading-relaxed mt-3">{{ $b->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===== OTHER SECTORS ===== --}}
    <section class="py-16 lg:py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <h2 class="text-xl font-black text-[#141414] mb-8 reveal">{{ __('sectors_show.other_sectors.heading') }}</h2>

            <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach ($other_sectors as $o)
                    <a href="{{ $o->is_coming_soon ? 'javascript:void(0)' : route('sectors.show', $o->slug) }}"
                       class="reveal group flex items-center gap-3 bg-[#f7f7f8] rounded-2xl p-4 ring-1 ring-black/5
                              {{ $o->is_coming_soon ? 'opacity-60 cursor-default' : 'hover:bg-white hover:shadow-lg' }} transition-all">
                        <span class="shrink-0 w-10 h-10 rounded-xl bg-brand-light text-brand grid place-items-center
                                     group-hover:bg-brand group-hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $o->icon }}"/></svg>
                        </span>
                        <span class="text-[13px] font-bold text-[#141414] leading-snug">{{ $o->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

@endsection
