@extends('layouts.app')

@section('title', 'الصفحة غير موجودة | مجموعة شورى')
@section('description', 'عذراً، الصفحة التي تحاول الوصول إليها غير موجودة أو تم نقلها. يمكنك العودة للصفحة الرئيسية لمجموعة شورى.')

@section('content')

    {{-- ===== 404 PAGE HERO / CONTENT ===== --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-[#fbe9ea]/40 to-white py-24 lg:py-36 min-h-[70vh] flex items-center">
        {{-- Background grid and light blur --}}
        <div class="pointer-events-none absolute inset-0 opacity-[0.03]"
             style="background-image:radial-gradient(#141414 1px, transparent 1px); background-size:22px 22px;"></div>
        <div class="absolute -top-40 right-10 w-96 h-96 bg-brand/10 rounded-full blur-3xl anim-glow"></div>
        <div class="absolute -bottom-40 left-10 w-96 h-96 bg-brand-dark/10 rounded-full blur-3xl anim-glow" style="animation-delay: 2s"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 w-full text-center">
            <div class="flex flex-col items-center">
                
                {{-- Stylized 404 Visual element --}}
                <div class="relative mb-8 select-none anim-pop">
                    {{-- Giant glowing blurred backdrop --}}
                    <div class="absolute inset-0 rounded-full bg-brand/10 blur-2xl transform scale-110"></div>
                    
                    {{-- Text --}}
                    <h1 class="relative text-8xl sm:text-9xl font-black text-[#141414] tracking-widest drop-shadow-sm flex items-center justify-center">
                        <span>4</span>
                        {{-- Water droplet / pool ripple replacement for '0' --}}
                        <span class="relative mx-2 inline-block w-20 h-20 sm:w-28 sm:h-28 rounded-full bg-brand text-white grid place-items-center shadow-lg shadow-brand/20 anim-float">
                            <svg class="w-10 h-10 sm:w-14 sm:h-14 animate-pulse" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c-3.5 4-6 7.2-6 10.5a6 6 0 0 0 12 0C18 10.2 15.5 7 12 3Z"/>
                            </svg>
                            <span class="absolute -inset-2 rounded-full border border-brand/30 anim-ping"></span>
                        </span>
                        <span>4</span>
                    </h1>
                </div>

                {{-- Message --}}
                <h2 class="text-2xl sm:text-3xl font-black text-[#141414] mb-4 anim-fade-up" style="animation-delay: 0.1s">
                    عذراً، الصفحة غير موجودة!
                </h2>
                <p class="max-w-md text-base text-[#4b4b4b] leading-relaxed mb-10 anim-fade-up" style="animation-delay: 0.2s">
                    يبدو أن الصفحة التي تبحث عنها قد تم نقلها، أو حذفها، أو أن العنوان الذي أدخلته غير صحيح.
                </p>

                {{-- Action Buttons --}}
                <div class="flex flex-wrap items-center justify-center gap-4 anim-fade-up" style="animation-delay: 0.3s">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-7 py-3 rounded-xl font-bold transition-all shadow-md shadow-brand/15 hover:shadow-xl">
                        العودة للرئيسية
                        <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                    </a>
                    
                    <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 border-2 border-[#141414] hover:bg-[#141414] hover:text-white text-[#141414] px-7 py-3 rounded-xl font-bold transition-colors">
                        الإبلاغ عن مشكلة
                    </a>
                </div>

                {{-- Quick Nav Suggestions --}}
                <div class="mt-16 pt-8 border-t border-gray-100 w-full max-w-2xl anim-fade-up" style="animation-delay: 0.4s">
                    <span class="block text-xs font-bold text-[#9a9a9a] uppercase tracking-wider mb-4">قد تبحث عن أحد هذه الأقسام:</span>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach ([
                            [url('/services'), 'خدماتنا'],
                            [url('/products'), 'المنتجات'],
                            [url('/projects'), 'مشاريعنا'],
                            [url('/news'), 'أخبارنا']
                        ] as [$href, $label])
                            <a href="{{ $href }}" class="p-3 bg-gray-50 hover:bg-brand-light hover:text-brand rounded-xl text-sm font-bold text-[#141414] transition-all ring-1 ring-black/5">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
