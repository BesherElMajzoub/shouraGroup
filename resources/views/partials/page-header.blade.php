{{--
    Reusable page header — breadcrumb + eyebrow + title + description.
    Params:
      $current : breadcrumb label for the active page
      $eyebrow : small uppercase tagline shown above the title
      $title   : main H1 text
      $desc    : intro paragraph
      $parent  : optional ['label' => .., 'href' => ..] breadcrumb level between home and $current
--}}
<section class="relative overflow-hidden bg-gradient-to-b from-brand-light/60 to-white border-b border-gray-100">
    {{-- top accent line --}}
    <div class="absolute top-0 inset-x-0 h-1 bg-brand"></div>

    {{-- dotted texture (matches the homepage hero) --}}
    <div class="pointer-events-none absolute inset-0 opacity-[0.05]"
         style="background-image:radial-gradient(#141414 1px, transparent 1px); background-size:22px 22px;"></div>

    {{-- soft glow + concentric rings fill the empty side --}}
    <div class="pointer-events-none absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-brand/10 blur-3xl"></div>
    <svg class="pointer-events-none absolute -bottom-16 -left-16 w-64 h-64 lg:w-80 lg:h-80 text-brand/20 hidden md:block anim-float"
         viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="1.4">
        <circle cx="100" cy="100" r="42"/>
        <circle cx="100" cy="100" r="68"/>
        <circle cx="100" cy="100" r="94"/>
        <circle cx="100" cy="100" r="6" fill="currentColor" stroke="none"/>
    </svg>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 py-12 lg:py-16">
        {{-- breadcrumb --}}
        <nav class="text-sm text-[#888] mb-6 flex items-center gap-2">
            <a href="{{ url('/') }}" class="hover:text-brand transition-colors">{{ __('ui.nav.home') }}</a>
            <svg class="w-3.5 h-3.5 text-[#ccc] rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            @isset ($parent)
                <a href="{{ $parent['href'] }}" class="hover:text-brand transition-colors">{{ $parent['label'] }}</a>
                <svg class="w-3.5 h-3.5 text-[#ccc] rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            @endisset
            <span class="text-[#141414] font-medium">{{ $current }}</span>
        </nav>

        <div class="max-w-2xl">
            {{-- eyebrow with brand accent dash --}}
            <div class="flex items-center gap-3 mb-4">
                <span class="w-8 h-1 rounded-full bg-brand"></span>
                <span class="text-brand font-bold text-xs tracking-widest uppercase">{{ $eyebrow }}</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#141414] leading-tight">{{ $title }}</h1>

            <p class="mt-5 text-[#555] leading-loose text-[15px]">{{ $desc }}</p>
        </div>
    </div>
</section>
