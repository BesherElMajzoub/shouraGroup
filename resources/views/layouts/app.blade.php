<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteDesc = 'شورى إخوان — الشركة الرائدة في التوريدات الهندسية في سوريا منذ 1978: مضخات المياه، مجموعات التوليد، ضواغط الهواء، الغازات الطبية، والعدد الصناعية.';
        $contactEmail = setting('contact_email', 'info@shorabrothers.com');
        $phoneMain = setting('phone_main', '011 2233743');
        $phoneTel = '+963' . ltrim(preg_replace('/\D/', '', $phoneMain), '0');
    @endphp

    <title>@yield('title', 'شورى إخوان | التوريدات الهندسية في سوريا')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/shora-logo.svg') }}">
    <meta name="description" content="@yield('description', $siteDesc)">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'شورى إخوان | التوريدات الهندسية في سوريا')">
    <meta property="og:description" content="@yield('description', $siteDesc)">
    <meta property="og:image" content="{{ asset('images/about_skyscrapers.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'شورى إخوان | التوريدات الهندسية في سوريا')">
    <meta property="twitter:description" content="@yield('description', $siteDesc)">
    <meta property="twitter:image" content="{{ asset('images/about_skyscrapers.png') }}">

    <!-- Structured Data JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Corporation",
      "name": "شورى إخوان",
      "alternateName": "Shora Brothers",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('images/shora-logo.svg') }}",
      "foundingDate": "1978",
      "email": "{{ $contactEmail }}",
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "{{ $phoneTel }}",
        "contactType": "customer service",
        "areaServed": "SY",
        "availableLanguage": ["Arabic", "English"]
      },
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "المرجة",
        "addressLocality": "دمشق",
        "addressCountry": "SY"
      }
    }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body { font-family: {{ app()->getLocale() === 'ar' ? '"Tajawal"' : '"Inter"' }}, system-ui, sans-serif; }
            .text-brand { color:#e11d26 } .bg-brand{ background-color:#e11d26 }
            .bg-brand-dark{ background-color:#b3141b } .border-brand{ border-color:#e11d26 }
            .from-brand-light\/60 { --tw-gradient-from:#fbe9ea99 }
            .bg-brand\/10{ background-color:#e11d261a }
            .hover\:bg-brand-dark:hover{ background-color:#b3141b }
            html{ scroll-behavior:smooth }
        </style>
    @endif
</head>
<body class="bg-white text-[#141414] antialiased">

    {{-- ============ 1) TOP BAR — الرئيسية فقط ============ --}}
    @if($onHome ?? request()->is('/'))
    <div class="bg-[#141414] text-white text-[13px]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 flex items-center justify-between h-10">
            <div class="flex items-center gap-4">
                <a href="tel:{{ $phoneTel }}" class="flex items-center gap-1.5 hover:text-brand transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                    <span dir="ltr">{{ $phoneMain }}</span>
                </a>
                <a href="mailto:{{ $contactEmail }}" class="hidden sm:flex items-center gap-1.5 text-white/70 hover:text-brand transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                    <span dir="ltr">{{ $contactEmail }}</span>
                </a>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-3 text-white/70">
                    <a href="#" aria-label="Facebook" class="hover:text-brand transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12Z"/></svg></a>
                    <a href="#" aria-label="Instagram" class="hover:text-brand transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41a3.7 3.7 0 0 1-1.38-.9 3.7 3.7 0 0 1-.9-1.38c-.16-.42-.36-1.06-.41-2.23C2.17 15.58 2.16 15.2 2.16 12s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41C8.42 2.17 8.8 2.16 12 2.16Zm0 3.68A6.16 6.16 0 1 0 18.16 12 6.16 6.16 0 0 0 12 5.84Zm0 10.16A4 4 0 1 1 16 12a4 4 0 0 1-4 4Zm6.41-10.4a1.44 1.44 0 1 1-1.44-1.44 1.44 1.44 0 0 1 1.44 1.44Z"/></svg></a>
                    <a href="#" aria-label="X" class="hover:text-brand transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.66l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.45-6.231Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/></svg></a>
                </div>
                <span class="w-px h-4 bg-white/20"></span>
                <a href="{{ url('/wholesale') }}" class="flex items-center gap-1.5 font-bold hover:text-brand transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9l1.5-4.5A1 1 0 0 1 5.45 4h13.1a1 1 0 0 1 .95.5L21 9M3 9h18M3 9v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V9"/></svg>
                    مبيعات الجملة
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- ============ 2) NAVBAR ============ --}}
    @php
        $home = url('/');
        $onHome = request()->is('/');

        $nav = [
            ['href' => $home,            'label' => 'الرئيسية',        'active' => $onHome],
            ['href' => url('/about'),    'label' => 'من نحن',          'active' => request()->is('about')],
            ['href' => url('/sectors'),  'label' => 'قطاعاتنا',        'active' => request()->is('sectors*')],
            ['href' => url('/services'), 'label' => 'خدماتنا وحلولنا', 'active' => request()->is('services')],
            ['href' => url('/brands'),   'label' => 'العلامات التجارية','active' => request()->is('brands')],
            ['href' => url('/projects'), 'label' => 'مشاريعنا',        'active' => request()->is('projects')],
            ['href' => url('/news'),     'label' => 'الأخبار',         'active' => request()->is('news*')],
            ['href' => url('/careers'),  'label' => 'انضم إلى فريقنا', 'active' => request()->is('careers')],
            ['href' => url('/contact'),  'label' => 'اتصل بنا',        'active' => request()->is('contact')],
        ];
    @endphp
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-100 shadow-sm">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 flex items-center justify-between h-20">
            <a href="{{ $home }}" class="flex items-center shrink-0">
                <img src="{{ asset('images/shora-logo.png') }}" alt="شورى إخوان" class="h-12 w-auto">
            </a>

            <ul class="hidden lg:flex items-center gap-4 xl:gap-6 text-[13.5px] xl:text-[15px] font-medium text-[#141414] whitespace-nowrap">
                @foreach ($nav as $item)
                    <li><a href="{{ $item['href'] }}" class="{{ $item['active'] ? 'text-brand' : 'hover:text-brand transition-colors' }}">{{ $item['label'] }}</a></li>
                @endforeach
            </ul>

            <div class="flex items-center gap-3">
                <a href="{{ route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                   class="inline-flex items-center justify-center min-w-11 h-9 px-3 rounded-full border border-gray-200 text-xs font-black text-[#141414] hover:border-brand hover:text-brand transition-colors"
                   aria-label="{{ app()->getLocale() === 'ar' ? 'Switch to English' : 'التبديل إلى العربية' }}"
                   lang="{{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}" dir="{{ app()->getLocale() === 'ar' ? 'ltr' : 'rtl' }}">
                    {{ app()->getLocale() === 'ar' ? 'EN' : 'العربية' }}
                </a>
                <button id="menuBtn" class="lg:hidden p-2 -mr-2 text-[#141414]" aria-label="القائمة">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
            </div>
        </nav>

        <ul id="mobileMenu" class="hidden lg:hidden border-t border-gray-100 bg-white px-6 py-3 space-y-1 text-[15px] font-medium">
            @foreach ($nav as $item)
                <li><a href="{{ $item['href'] }}" class="block py-2 {{ $item['active'] ? 'text-brand' : '' }}">{{ $item['label'] }}</a></li>
            @endforeach
            <li class="pt-2 mt-1 border-t border-gray-100">
                <a href="{{ url('/wholesale') }}" class="block py-2 {{ request()->is('wholesale') ? 'text-brand' : '' }}">مبيعات الجملة</a>
            </li>
            <li class="pt-2 mt-1 border-t border-gray-100">
                <a href="{{ route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="block py-2 font-black" lang="{{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}">
                    {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
                </a>
            </li>
        </ul>
    </header>

    @yield('content')

    {{-- ============ زر مبيعات الجملة العائم ============ --}}
    <style>
        @keyframes partnerPulse {
            0%, 100% { box-shadow: 0 12px 28px -6px rgba(225,29,38,.5), 0 0 0 0 rgba(225,29,38,.45); }
            50%      { box-shadow: 0 12px 28px -6px rgba(225,29,38,.5), 0 0 0 14px rgba(225,29,38,0); }
        }
        #partnerBtn { animation: partnerPulse 2.4s ease-in-out infinite; }
        @media (prefers-reduced-motion: reduce) { #partnerBtn { animation: none; } }
    </style>

    @unless (request()->is('wholesale'))
    <a id="partnerBtn" href="{{ url('/wholesale') }}" aria-label="كن شريكاً — مبيعات الجملة"
       class="group fixed bottom-5 left-5 sm:bottom-6 sm:left-6 z-[60] inline-flex items-center gap-2.5
              rounded-full bg-brand text-white
              px-5 sm:px-6 py-3.5 font-bold text-sm ring-1 ring-white/25
              hover:bg-brand-dark hover:-translate-y-0.5 transition-all">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0ZM6.94 15.52A5.995 5.995 0 0 1 12 12.75a5.995 5.995 0 0 1 5.06 2.77M2.26 18.2a3 3 0 0 1 4.68-2.72M21.74 18.2a3 3 0 0 0-4.68-2.72M17.06 18.72A11.94 11.94 0 0 1 12 21c-1.83 0-3.57-.41-5.06-1.14"/>
        </svg>
        كن شريكاً
    </a>
    @endunless

    {{-- ============ FOOTER ============ --}}
    <footer id="contact" class="scroll-mt-24 bg-[#141414] text-white relative overflow-hidden">
        <img src="{{ asset('images/shora-logo.png') }}" alt=""
             class="pointer-events-none absolute -left-20 -top-16 w-[28rem] opacity-[0.04] brightness-0 invert">

        <div class="relative border-b border-white/10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 py-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="flex items-center gap-4">
                    <span class="shrink-0 w-12 h-12 rounded-xl bg-brand grid place-items-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                    </span>
                    <div>
                        <div class="text-xs text-white/50">اتصل بنا</div>
                        <a href="tel:{{ $phoneTel }}" class="font-bold hover:text-brand transition-colors" dir="ltr">{{ $phoneMain }}</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="shrink-0 w-12 h-12 rounded-xl bg-brand grid place-items-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                    </span>
                    <div>
                        <div class="text-xs text-white/50">البريد الإلكتروني</div>
                        <a href="mailto:{{ $contactEmail }}" class="font-bold hover:text-brand transition-colors" dir="ltr">{{ $contactEmail }}</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="shrink-0 w-12 h-12 rounded-xl bg-brand grid place-items-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    </span>
                    <div>
                        <div class="text-xs text-white/50">العنوان</div>
                        <div class="font-bold">دمشق – المرجة، سوريا</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 py-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
            <div class="lg:col-span-1">
                <img src="{{ asset('images/shora-logo.png') }}" alt="شورى إخوان" class="h-14 w-auto brightness-0 invert mb-5">
                <p class="text-white/60 text-sm leading-relaxed mb-5">
                    الشركة الرائدة في التوريدات الهندسية في سوريا منذ عام 1978 — حلول متكاملة في ضخ المياه، توليد الكهرباء، ضواغط الهواء، الغازات الطبية، والعدد الصناعية.
                </p>
                <div class="flex items-center gap-3">
                    @foreach (['facebook','instagram','x'] as $s)
                        <a href="#" aria-label="{{ $s }}" class="w-9 h-9 rounded-full bg-white/10 hover:bg-brand grid place-items-center transition-colors">
                            @if ($s === 'facebook')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12Z"/></svg>
                            @elseif ($s === 'instagram')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41a3.7 3.7 0 0 1-1.38-.9 3.7 3.7 0 0 1-.9-1.38c-.16-.42-.36-1.06-.41-2.23C2.17 15.58 2.16 15.2 2.16 12s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41C8.42 2.17 8.8 2.16 12 2.16Zm0 3.68A6.16 6.16 0 1 0 18.16 12 6.16 6.16 0 0 0 12 5.84Zm0 10.16A4 4 0 1 1 16 12a4 4 0 0 1-4 4Zm6.41-10.4a1.44 1.44 0 1 1-1.44-1.44 1.44 1.44 0 0 1 1.44 1.44Z"/></svg>
                            @else
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.66l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.45-6.231Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/></svg>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-5 relative inline-block">خريطة الموقع
                    <span class="absolute -bottom-2 right-0 w-8 h-0.5 bg-brand"></span>
                </h4>
                <ul class="space-y-3 text-sm text-white/60">
                    @foreach ([[$home, 'الرئيسية'], [url('/about'), 'من نحن'], [url('/sectors'), 'قطاعاتنا'], [url('/services'), 'خدماتنا وحلولنا'], [url('/brands'), 'العلامات التجارية']] as [$href, $label])
                        <li><a href="{{ $href }}" class="hover:text-brand hover:pr-1 transition-all">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-5 relative inline-block">روابط سريعة
                    <span class="absolute -bottom-2 right-0 w-8 h-0.5 bg-brand"></span>
                </h4>
                <ul class="space-y-3 text-sm text-white/60">
                    @foreach ([[url('/projects'), 'مشاريعنا'], [url('/news'), 'الأخبار'], [url('/wholesale'), 'مبيعات الجملة'], [url('/careers'), 'انضم إلى فريقنا'], [url('/contact'), 'اتصل بنا']] as [$href, $label])
                        <li><a href="{{ $href }}" class="hover:text-brand hover:pr-1 transition-all">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-5 relative inline-block">فروعنا
                    <span class="absolute -bottom-2 right-0 w-8 h-0.5 bg-brand"></span>
                </h4>
                <ul class="space-y-4 text-sm text-white/60">
                    @foreach ($footerBranches as $b)
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-brand shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                            <span>
                                {{ $b->address }}
                                @if ($b->phone)
                                    <a href="tel:{{ preg_replace('/\s/', '', $b->phone) }}" class="block text-white/40 hover:text-brand transition-colors" dir="ltr">{{ $b->phone }}</a>
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="relative border-t border-white/10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/50">
                <p>© {{ date('Y') }} جميع الحقوق محفوظة لمجموعة شورى إخوان.</p>
                <p>صُمّم وطُوّر بكل احترافية.</p>
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('menuBtn');
        const menu = document.getElementById('mobileMenu');
        btn?.addEventListener('click', () => menu.classList.toggle('hidden'));
        menu?.querySelectorAll('a').forEach(a => a.addEventListener('click', () => menu.classList.add('hidden')));

        // Scroll reveal
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('in-view'); io.unobserve(e.target); }
            });
        }, { threshold: 0.15 });
        document.querySelectorAll('.reveal').forEach(el => io.observe(el));

        // Pulls the first message out of a Laravel 422 response so the public
        // forms can name the offending field instead of showing a generic error.
        function firstError(body) {
            const errors = body && body.errors;
            if (errors) {
                const first = Object.values(errors)[0];
                if (Array.isArray(first) && first.length) return first[0];
            }
            return (body && body.message) || '';
        }
    </script>
    @stack('scripts')
</body>
</html>
