<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'مجموعة شورى')</title>
    <meta name="description" content="@yield('description', 'مجموعة شورى — مجموعة شركات سورية رائدة في مجال المياه والمسابح والمقاولات.')">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'مجموعة شورى')">
    <meta property="og:description" content="@yield('description', 'مجموعة شورى — مجموعة شركات سورية رائدة في مجال المياه والمسابح والمقاولات.')">
    <meta property="og:image" content="{{ asset('images/about_skyscrapers.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'مجموعة شورى')">
    <meta property="twitter:description" content="@yield('description', 'مجموعة شورى — مجموعة شركات سورية رائدة في مجال المياه والمسابح والمقاولات.')">
    <meta property="twitter:image" content="{{ asset('images/about_skyscrapers.png') }}">

    <!-- Structured Data JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Corporation",
      "name": "مجموعة شورى",
      "alternateName": "Shora Group",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('images/shora-logo.svg') }}",
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "+963-11-234-5678",
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
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body { font-family: "Tajawal", system-ui, sans-serif; }
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
                <a href="tel:+963112345678" class="flex items-center gap-1.5 hover:text-brand transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                    <span dir="ltr">+963 11 234 5678</span>
                </a>
                <span class="hidden sm:flex items-center gap-1.5 text-white/70">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                    info@shora-group.sy
                </span>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-3 text-white/70">
                    <a href="#" aria-label="Facebook" class="hover:text-brand transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12Z"/></svg></a>
                    <a href="#" aria-label="Instagram" class="hover:text-brand transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41a3.7 3.7 0 0 1-1.38-.9 3.7 3.7 0 0 1-.9-1.38c-.16-.42-.36-1.06-.41-2.23C2.17 15.58 2.16 15.2 2.16 12s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41C8.42 2.17 8.8 2.16 12 2.16Zm0 3.68A6.16 6.16 0 1 0 18.16 12 6.16 6.16 0 0 0 12 5.84Zm0 10.16A4 4 0 1 1 16 12a4 4 0 0 1-4 4Zm6.41-10.4a1.44 1.44 0 1 1-1.44-1.44 1.44 1.44 0 0 1 1.44 1.44Z"/></svg></a>
                    <a href="#" aria-label="X" class="hover:text-brand transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.66l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.45-6.231Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/></svg></a>
                </div>
                <span class="w-px h-4 bg-white/20"></span>
                <button class="flex items-center gap-1 hover:text-brand transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.95 8.95 0 0 0 4.5-1.207M12 21a8.95 8.95 0 0 1-4.5-1.207M3 12h18M12 3c2.5 2.5 2.5 15 0 18M12 3C9.5 5.5 9.5 18.5 12 21"/></svg>
                    EN
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- ============ 2) NAVBAR ============ --}}
    @php
        $home = url('/');
        $onStory = request()->is('story');
        $onCompanies = request()->is('companies');
        $onProducts = request()->is('products');
        $onHome  = request()->is('/');
        $onServices = request()->is('services');
        $onContact = request()->is('contact');
        $onBranches = request()->is('branches');
        $onProjects = request()->is('projects');
        $onNews = request()->is('news');

        $nav = [
            ['href' => $home,            'label' => 'الرئيسية', 'active' => $onHome],
            ['href' => url('/story'),    'label' => 'قصتنا',    'active' => $onStory],
            ['href' => url('/services'), 'label' => 'خدماتنا',  'active' => $onServices],
            ['href' => url('/products'), 'label' => 'المنتجات', 'active' => $onProducts],
            ['href' => url('/projects'), 'label' => 'المشاريع', 'active' => $onProjects],
            ['href' => url('/companies'),'label' => 'الشركات', 'active' => $onCompanies],
            ['href' => url('/news'),     'label' => 'الأخبار',  'active' => $onNews],
            ['href' => url('/branches'), 'label' => 'فروعنا',   'active' => $onBranches],
            ['href' => url('/contact'),  'label' => 'اتصل بنا', 'active' => $onContact],
        ];
    @endphp
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-100 shadow-sm">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 flex items-center justify-between h-20">
            <a href="{{ $home }}" class="flex items-center shrink-0">
                <img src="{{ asset('images/shora-logo.svg') }}" alt="مجموعة شورى" class="h-12 w-auto">
            </a>

            <ul class="hidden lg:flex items-center gap-7 text-[15px] font-medium text-[#141414]">
                @foreach ($nav as $item)
                    <li><a href="{{ $item['href'] }}" class="{{ $item['active'] ? 'text-brand' : 'hover:text-brand transition-colors' }}">{{ $item['label'] }}</a></li>
                @endforeach
            </ul>

            <div class="flex items-center gap-3">
                <button id="menuBtn" class="lg:hidden p-2 -mr-2 text-[#141414]" aria-label="القائمة">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
            </div>
        </nav>

        <ul id="mobileMenu" class="hidden lg:hidden border-t border-gray-100 bg-white px-6 py-3 space-y-1 text-[15px] font-medium">
            @foreach ($nav as $item)
                <li><a href="{{ $item['href'] }}" class="block py-2 {{ $item['active'] ? 'text-brand' : '' }}">{{ $item['label'] }}</a></li>
            @endforeach
        </ul>
    </header>

    @yield('content')

    {{-- ============ زر "كن شريكاً" العائم + نموذجه ============ --}}
    @php
        $govs = ['دمشق','ريف دمشق','حلب','حمص','حماة','اللاذقية','طرطوس','إدلب','درعا','السويداء','القنيطرة','دير الزور','الرقة','الحسكة'];
        $bizTypes = ['محل تجزئة','تاجر جملة','مقاول','ورشة / مصنع','مكتب هندسي','أخرى'];
    @endphp

    <style>
        @keyframes partnerPulse {
            0%, 100% { box-shadow: 0 12px 28px -6px rgba(225,29,38,.5), 0 0 0 0 rgba(225,29,38,.45); }
            50%      { box-shadow: 0 12px 28px -6px rgba(225,29,38,.5), 0 0 0 14px rgba(225,29,38,0); }
        }
        #partnerBtn { animation: partnerPulse 2.4s ease-in-out infinite; }
        @media (prefers-reduced-motion: reduce) { #partnerBtn { animation: none; } }
    </style>

    {{-- الزر العائم على اليسار --}}
    <button id="partnerBtn" type="button" aria-label="كن شريكاً"
            class="group fixed bottom-5 left-5 sm:bottom-6 sm:left-6 z-[60] inline-flex items-center gap-2.5
                   rounded-full bg-brand text-white
                   px-5 sm:px-6 py-3.5 font-bold text-sm ring-1 ring-white/25
                   hover:bg-brand-dark hover:-translate-y-0.5 transition-all">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0ZM6.94 15.52A5.995 5.995 0 0 1 12 12.75a5.995 5.995 0 0 1 5.06 2.77M2.26 18.2a3 3 0 0 1 4.68-2.72M21.74 18.2a3 3 0 0 0-4.68-2.72M17.06 18.72A11.94 11.94 0 0 1 12 21c-1.83 0-3.57-.41-5.06-1.14"/>
        </svg>
        كن شريكاً
    </button>

    {{-- مودال نموذج "كن شريكاً" --}}
    <div id="partnerModal" class="fixed inset-0 z-[100] hidden" role="dialog" aria-modal="true" aria-labelledby="partnerTitle">
        <div id="partnerBackdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300"></div>

        <div class="absolute inset-0 overflow-y-auto p-4 sm:p-6 grid place-items-center">
            <div id="partnerCard" dir="rtl"
                 class="relative w-full max-w-2xl bg-white rounded-[2rem] shadow-2xl ring-1 ring-black/5
                        opacity-0 translate-y-4 transition-all duration-300">

                {{-- رأس النافذة --}}
                <div class="relative overflow-hidden rounded-t-[2rem] bg-gradient-to-l from-brand to-brand-dark px-7 py-7 text-white">
                    <svg class="pointer-events-none absolute -left-6 -top-6 w-40 h-40 opacity-10" fill="currentColor" viewBox="0 0 24 24"><path d="M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                    <button type="button" data-partner-close aria-label="إغلاق"
                            class="absolute top-4 left-4 w-9 h-9 rounded-full bg-white/15 hover:bg-white/30 grid place-items-center transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    </button>
                    <span class="inline-block text-white/80 font-bold text-xs mb-1.5">انضمّ إلى شبكة شركاء شورى</span>
                    <h2 id="partnerTitle" class="text-2xl sm:text-3xl font-black">كن شريكاً</h2>
                    <p class="text-white/85 text-sm mt-2 leading-relaxed max-w-md">
                        سجّل بيانات محلّك أو نشاطك التجاري وسيتواصل معك فريق الشراكات لبحث فرص التعاون والتوزيع.
                    </p>
                </div>

                {{-- جسم النموذج --}}
                <div class="p-7 sm:p-8">
                    {{-- رسالة النجاح --}}
                    <div id="partnerSuccess" class="hidden mb-6 p-4 rounded-xl bg-green-50 text-green-800 text-sm font-bold text-right border border-green-200">
                        شكراً لك! تم استلام طلب الشراكة بنجاح، وسيتواصل معك فريق الشراكات في أقرب وقت ممكن.
                    </div>

                    <form id="partnerForm" class="space-y-5 text-right">
                        <div class="grid sm:grid-cols-2 gap-5">
                            {{-- المحافظة --}}
                            <div>
                                <label for="p_gov" class="block text-xs font-bold text-[#141414] mb-2">المحافظة <span class="text-brand">*</span></label>
                                <div class="relative">
                                    <select id="p_gov" required
                                            style="-webkit-appearance:none; -moz-appearance:none; appearance:none;"
                                            class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 pl-10 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                                        <option value="" disabled selected>اختر المحافظة</option>
                                        @foreach ($govs as $g)
                                            <option value="{{ $g }}">{{ $g }}</option>
                                        @endforeach
                                    </select>
                                    <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                                </div>
                            </div>

                            {{-- المدينة / المنطقة --}}
                            <div>
                                <label for="p_city" class="block text-xs font-bold text-[#141414] mb-2">المدينة / المنطقة <span class="text-brand">*</span></label>
                                <input type="text" id="p_city" required placeholder="مثال: المرجة، باب النصر..."
                                       class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-5">
                            {{-- اسم المحل --}}
                            <div>
                                <label for="p_shop" class="block text-xs font-bold text-[#141414] mb-2">اسم المحل / النشاط التجاري <span class="text-brand">*</span></label>
                                <input type="text" id="p_shop" required
                                       class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                            </div>

                            {{-- نوع النشاط --}}
                            <div>
                                <label for="p_type" class="block text-xs font-bold text-[#141414] mb-2">نوع النشاط <span class="text-brand">*</span></label>
                                <div class="relative">
                                    <select id="p_type" required
                                            style="-webkit-appearance:none; -moz-appearance:none; appearance:none;"
                                            class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 pl-10 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                                        <option value="" disabled selected>اختر نوع النشاط</option>
                                        @foreach ($bizTypes as $t)
                                            <option value="{{ $t }}">{{ $t }}</option>
                                        @endforeach
                                    </select>
                                    <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-5">
                            {{-- الاسم الكامل --}}
                            <div>
                                <label for="p_name" class="block text-xs font-bold text-[#141414] mb-2">الاسم الكامل <span class="text-brand">*</span></label>
                                <input type="text" id="p_name" required
                                       class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                            </div>

                            {{-- رقم الهاتف --}}
                            <div>
                                <label for="p_phone" class="block text-xs font-bold text-[#141414] mb-2">رقم الهاتف <span class="text-brand">*</span></label>
                                <input type="tel" id="p_phone" required placeholder="09xxxxxxxx" dir="ltr"
                                       class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all text-left">
                            </div>
                        </div>

                        {{-- البريد الإلكتروني --}}
                        <div>
                            <label for="p_email" class="block text-xs font-bold text-[#141414] mb-2">البريد الإلكتروني <span class="text-gray-400 font-normal">(اختياري)</span></label>
                            <input type="email" id="p_email" dir="ltr"
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all text-left">
                        </div>

                        {{-- تفاصيل إضافية --}}
                        <div>
                            <label for="p_msg" class="block text-xs font-bold text-[#141414] mb-2">تفاصيل إضافية</label>
                            <textarea id="p_msg" rows="3" placeholder="أخبرنا عن نشاطك ومجال التعاون الذي تطمح إليه..."
                                      class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all resize-none"></textarea>
                        </div>

                        {{-- أزرار --}}
                        <div class="flex flex-col-reverse sm:flex-row items-center gap-3 pt-1">
                            <button type="button" data-partner-close
                                    class="w-full sm:w-auto px-6 py-3.5 rounded-xl font-bold text-sm text-[#141414] bg-gray-100 hover:bg-gray-200 transition-colors">
                                إلغاء
                            </button>
                            <button type="submit" id="partnerSubmit"
                                    class="w-full sm:flex-1 inline-flex items-center justify-center gap-2 bg-brand hover:bg-brand-dark text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/25">
                                إرسال طلب الشراكة
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const btn      = document.getElementById('partnerBtn');
            const modal    = document.getElementById('partnerModal');
            if (!btn || !modal) return;
            const backdrop = document.getElementById('partnerBackdrop');
            const card     = document.getElementById('partnerCard');
            const closers  = modal.querySelectorAll('[data-partner-close]');

            function openModal() {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                requestAnimationFrame(() => {
                    backdrop.classList.remove('opacity-0');
                    card.classList.remove('opacity-0', 'translate-y-4');
                });
            }
            function closeModal() {
                backdrop.classList.add('opacity-0');
                card.classList.add('opacity-0', 'translate-y-4');
                document.body.style.overflow = '';
                setTimeout(() => modal.classList.add('hidden'), 300);
            }

            btn.addEventListener('click', openModal);
            backdrop.addEventListener('click', closeModal);
            closers.forEach(c => c.addEventListener('click', closeModal));
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
            });

            // إرسال تجريبي (واجهة فقط — مطابق لنموذج التواصل)
            const form = document.getElementById('partnerForm');
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const submitBtn = document.getElementById('partnerSubmit');
                const success   = document.getElementById('partnerSuccess');
                const original  = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'جاري الإرسال...';
                setTimeout(() => {
                    success.classList.remove('hidden');
                    form.reset();
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = original;
                    success.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 1200);
            });
        })();
    </script>

    {{-- ============ FOOTER ============ --}}
    <footer id="contact" class="scroll-mt-24 bg-[#141414] text-white relative overflow-hidden">
        <img src="{{ asset('images/shora-logo.svg') }}" alt=""
             class="pointer-events-none absolute -left-20 -top-16 w-[28rem] opacity-[0.04] brightness-0 invert">

        <div class="relative border-b border-white/10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 py-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="flex items-center gap-4">
                    <span class="shrink-0 w-12 h-12 rounded-xl bg-brand grid place-items-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                    </span>
                    <div>
                        <div class="text-xs text-white/50">اتصل بنا</div>
                        <a href="tel:+963112345678" class="font-bold hover:text-brand transition-colors" dir="ltr">+963 11 234 5678</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="shrink-0 w-12 h-12 rounded-xl bg-brand grid place-items-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                    </span>
                    <div>
                        <div class="text-xs text-white/50">البريد الإلكتروني</div>
                        <a href="mailto:info@shora-group.sy" class="font-bold hover:text-brand transition-colors">info@shora-group.sy</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="shrink-0 w-12 h-12 rounded-xl bg-brand grid place-items-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    </span>
                    <div>
                        <div class="text-xs text-white/50">العنوان</div>
                        <div class="font-bold">دمشق – سوريا</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 py-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
            <div class="lg:col-span-1">
                <img src="{{ asset('images/shora-logo.svg') }}" alt="مجموعة شورى" class="h-14 w-auto brightness-0 invert mb-5">
                <p class="text-white/60 text-sm leading-relaxed mb-5">
                    مجموعة شركات سورية رائدة في مجال المياه والمسابح والمقاولات، نقدّم حلولاً متكاملة بأعلى معايير الجودة.
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
                    @foreach ([[$home, 'الرئيسية'], [$home.'#about', 'من نحن'], [url('/story'), 'قصتنا'], [url('/services'), 'خدماتنا'], [url('/companies'), 'شركاتنا']] as [$href, $label])
                        <li><a href="{{ $href }}" class="hover:text-brand hover:pr-1 transition-all">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-5 relative inline-block">روابط سريعة
                    <span class="absolute -bottom-2 right-0 w-8 h-0.5 bg-brand"></span>
                </h4>
                <ul class="space-y-3 text-sm text-white/60">
                    @foreach ([[$home.'#news', 'الأخبار'], [url('/branches'), 'فروعنا'], [url('/contact'), 'اتصل بنا'], [url('/products'), 'المنتجات'], [url('/projects'), 'المشاريع']] as [$href, $label])
                        <li><a href="{{ $href }}" class="hover:text-brand hover:pr-1 transition-all">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-5 relative inline-block">فروعنا
                    <span class="absolute -bottom-2 right-0 w-8 h-0.5 bg-brand"></span>
                </h4>
                <ul class="space-y-4 text-sm text-white/60">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-brand shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        وحدة دمشق – المرجة
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-brand shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        وحدة برامكة – الجمارك
                    </li>
                </ul>
            </div>
        </div>

        <div class="relative border-t border-white/10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/50">
                <p>© {{ date('Y') }} جميع الحقوق محفوظة لمجموعة شورى.</p>
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

        // Companies coverflow carousel (homepage only)
        (function () {
            const stage = document.getElementById('compStage');
            if (!stage) return;
            const slides = [...stage.querySelectorAll('.comp-slide')];
            const dots   = [...document.querySelectorAll('.comp-dot')];
            const fDesc  = document.getElementById('featDesc');
            const n = slides.length;
            if (!n) return;
            let active = 0, timer;

            function layout() {
                const spacing = window.innerWidth < 640 ? 145 : 215;
                slides.forEach((el, i) => {
                    let off = i - active;
                    if (off >  n / 2) off -= n;   // أقصر مسافة دائرية
                    if (off < -n / 2) off += n;
                    const abs = Math.abs(off);
                    const scale   = off === 0 ? 1 : Math.max(0.62, 1 - abs * 0.26);
                    const opacity = abs > 2 ? 0 : (off === 0 ? 1 : 0.5);
                    el.style.transform     = `translate(-50%,-50%) translateX(${off * spacing}px) scale(${scale})`;
                    el.style.opacity       = opacity;
                    el.style.zIndex        = String(50 - abs);
                    el.style.pointerEvents = abs > 2 ? 'none' : 'auto';
                    el.classList.toggle('is-active', off === 0);
                });
                if (fDesc) {
                    fDesc.style.opacity = 0;
                    setTimeout(() => { fDesc.textContent = slides[active].dataset.desc; fDesc.style.opacity = 1; }, 180);
                }
                dots.forEach((d, idx) => {
                    const a = idx === active;
                    d.classList.toggle('w-7', a);
                    d.classList.toggle('bg-brand', a);
                    d.classList.toggle('w-2', !a);
                    d.classList.toggle('bg-white/30', !a);
                });
            }
            function go(i) { active = (i + n) % n; layout(); }
            function restart() { clearInterval(timer); timer = setInterval(() => go(active + 1), 3500); }

            slides.forEach((el, i) => el.addEventListener('click', () => { go(i); restart(); }));
            dots.forEach((d, i) => d.addEventListener('click', () => { go(i); restart(); }));
            const prev = document.getElementById('compPrev');
            const next = document.getElementById('compNext');
            if (prev) prev.addEventListener('click', () => { go(active - 1); restart(); });
            if (next) next.addEventListener('click', () => { go(active + 1); restart(); });
            window.addEventListener('resize', layout);

            layout();
            restart();
        })();
    </script>
    @stack('scripts')
</body>
</html>
