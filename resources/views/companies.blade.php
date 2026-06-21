@extends('layouts.app')

@section('title', 'الشركات | مجموعة شورى')
@section('description', 'شركات مجموعة شورى المتخصصة في المياه والمسابح والمقاولات والتجارة في سوريا.')

@section('content')

    @php
        $companies = [
            ['name' => 'شورى للمياه',       'tag' => 'معالجة وتحلية المياه', 'dept' => 'قسم معالجة وتحلية المياه', 'desc' => 'ثقة العملاء أهّلت الشركة لتنفيذ مشاريع محطات تحلية ومعالجة المياه للقطاعين الحكومي والخاص، بأحدث التقنيات وأعلى معايير الجودة.'],
            ['name' => 'شورى للمسابح',      'tag' => 'تصميم وتنفيذ المسابح', 'dept' => 'قسم المسابح والبحيرات', 'desc' => 'خبرة متكاملة في تصميم وبناء وتجهيز المسابح بمختلف أنواعها مع أنظمة التنقية والإضاءة والتدفئة الحديثة.'],
            ['name' => 'شورى للمقاولات',    'tag' => 'مقاولات عامة',         'dept' => 'قسم المقاولات والإنشاءات', 'desc' => 'تنفيذ المشاريع الإنشائية والمدنية بإدارة احترافية وكوادر مؤهّلة والتزام تام بالجودة والمواعيد.'],
            ['name' => 'شورى للصيانة',      'tag' => 'صيانة وتشغيل',         'dept' => 'قسم الصيانة والتشغيل', 'desc' => 'عقود صيانة وتشغيل دورية للأنظمة والمحطات تضمن استمرارية الأداء وكفاءته على المدى الطويل.'],
            ['name' => 'شورى للتجارة',      'tag' => 'توريد ومعدات',         'dept' => 'قسم التجارة والتوريد', 'desc' => 'توريد المضخات والفلاتر والمواد ومستلزمات المياه والمسابح من أبرز العلامات التجارية العالمية.'],
            ['name' => 'شورى للاستشارات',   'tag' => 'استشارات هندسية',      'dept' => 'قسم الاستشارات الهندسية', 'desc' => 'دراسات وتصاميم واستشارات هندسية متخصصة تساعد عملاءنا على اتخاذ القرار الأمثل لمشاريعهم.'],
        ];
    @endphp

    {{-- ===== PAGE HEADER ===== --}}
    <section class="relative overflow-hidden bg-white border-b border-gray-100">
        <div class="absolute top-0 inset-x-0 h-1 bg-brand"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.04]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:100px;"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 py-10 lg:py-14">
            <nav class="text-sm text-[#888] mb-4 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-brand transition-colors">الرئيسية</a>
                <svg class="w-3.5 h-3.5 text-[#ccc] rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#141414] font-medium">الشركات</span>
            </nav>
            <span class="inline-block text-brand font-bold text-xs tracking-widest uppercase mb-3">شركات المجموعة</span>
            <h1 class="text-3xl sm:text-4xl font-black text-[#141414] mb-3">شركاتنا</h1>
            <p class="max-w-xl text-[#555] leading-loose text-[15px]">
                ست شركات متخصصة تعمل تحت مظلة مجموعة شورى لتقديم حلول متكاملة في المياه والمسابح والمقاولات.
            </p>
        </div>
    </section>

    {{-- ===== FEATURED CAROUSEL (dark curved) ===== --}}
    <section class="relative bg-white pt-px">
        <div class="relative bg-[#141414] rounded-t-[2.5rem] lg:rounded-t-[4rem] overflow-hidden pt-16 lg:pt-20 pb-20 -mt-6">
            {{-- watermark --}}
            <img src="{{ asset('images/shora-logo.svg') }}" alt=""
                 class="pointer-events-none absolute right-6 top-24 w-[28rem] opacity-[0.05] brightness-0 invert">
            <span class="pointer-events-none select-none absolute inset-x-0 bottom-10 text-center
                         text-white/[0.03] font-black text-[6rem] lg:text-[10rem] leading-none whitespace-nowrap">SHORA GROUP</span>

            <h2 class="relative text-3xl sm:text-4xl font-black text-white text-center mb-14">شركاتنا</h2>

            <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
                <div class="flex items-center gap-6 lg:gap-10">
                    {{-- vertical dots --}}
                    <div id="coDots" class="hidden lg:flex flex-col gap-3 shrink-0">
                        @foreach ($companies as $i => $co)
                            <button type="button" data-index="{{ $i }}" aria-label="{{ $co['name'] }}"
                                    class="co-dot rounded-full transition-all duration-300 {{ $i === 0 ? 'w-3.5 h-3.5 bg-brand' : 'w-3 h-3 bg-white/25 hover:bg-white/50' }}"></button>
                        @endforeach
                    </div>

                    {{-- content --}}
                    <div class="flex-1 grid lg:grid-cols-2 gap-10 lg:gap-12 items-center">
                        {{-- featured text (right) --}}
                        <div class="order-2 lg:order-1 text-center lg:text-right">
                            <span class="inline-block text-brand font-bold text-sm mb-4">نبذة عن الشركة</span>
                            <h3 id="coName" class="text-3xl sm:text-4xl font-black text-white mb-3 transition-opacity duration-300">{{ $companies[0]['name'] }}</h3>
                            <span id="coTag" class="inline-block text-xs font-bold text-white/80 bg-white/10 rounded-full px-3 py-1 mb-5 transition-opacity duration-300">{{ $companies[0]['tag'] }}</span>
                            <p id="coDesc" class="text-white/70 leading-loose max-w-md mx-auto lg:mx-0 mb-8 transition-opacity duration-300">{{ $companies[0]['desc'] }}</p>
                            <a id="coContactLink" href="{{ url('/contact') }}?department={{ urlencode($companies[0]['dept']) }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-7 py-3 rounded-xl font-bold transition-colors">
                                المزيد عن الشركة
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            </a>
                        </div>

                        {{-- big logo card (left) with stacked depth --}}
                        <div class="order-1 lg:order-2 relative h-64 sm:h-72 flex items-center justify-center">
                            <div class="absolute w-44 h-52 rounded-3xl bg-white/5 -rotate-6 translate-x-6"></div>
                            <div class="absolute w-44 h-52 rounded-3xl bg-white/10 rotate-6 -translate-x-6"></div>
                            <div class="relative w-52 h-60 rounded-3xl bg-white shadow-2xl grid place-items-center anim-float">
                                {{-- placeholder: استبدلها بشعار الشركة PNG --}}
                                <img id="coLogo" src="{{ asset('images/shora-logo.svg') }}" alt="شعار الشركة"
                                     class="h-24 w-auto transition-opacity duration-300">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== ALL COMPANIES GRID ===== --}}
    <section class="py-20 lg:py-28 bg-[#f7f7f8]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">كل الشركات</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">شركات المجموعة</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($companies as $i => $co)
                    <article class="reveal group bg-white rounded-2xl overflow-hidden shadow-sm ring-1 ring-black/5
                                    hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                             style="transition-delay:{{ $i*0.07 }}s">
                        <div class="h-36 bg-brand-light grid place-items-center overflow-hidden">
                            {{-- placeholder: استبدلها بشعار الشركة PNG --}}
                            <img src="{{ asset('images/shora-logo.svg') }}" alt="{{ $co['name'] }}"
                                 class="h-16 w-auto group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="p-6">
                            <span class="inline-block text-xs font-bold text-brand bg-brand-light rounded-full px-3 py-1 mb-3">{{ $co['tag'] }}</span>
                            <h3 class="text-xl font-bold text-[#141414] mb-2">{{ $co['name'] }}</h3>
                            <p class="text-[#4b4b4b] text-sm leading-relaxed mb-4">{{ $co['desc'] }}</p>
                            <a href="{{ url('/contact') }}?department={{ urlencode($co['dept']) }}" class="inline-flex items-center gap-1 text-brand font-bold text-sm group-hover:gap-2 transition-all">
                                التفاصيل
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    (function () {
        const data = @json($companies);
        const dots = [...document.querySelectorAll('.co-dot')];
        const elName = document.getElementById('coName');
        const elTag  = document.getElementById('coTag');
        const elDesc = document.getElementById('coDesc');
        const elLogo = document.getElementById('coLogo');
        const elLink = document.getElementById('coContactLink');
        const contactUrl = @json(url('/contact'));
        if (!dots.length) return;
        let cur = 0, timer;

        function fade(el) { el.style.opacity = 0; setTimeout(() => el.style.opacity = 1, 180); }

        function select(i) {
            cur = i;
            [elName, elTag, elDesc, elLogo].forEach(fade);
            setTimeout(() => {
                elName.textContent = data[i].name;
                elTag.textContent  = data[i].tag;
                elDesc.textContent = data[i].desc;
                if (elLink && data[i].dept) {
                    elLink.href = contactUrl + '?department=' + encodeURIComponent(data[i].dept);
                }
            }, 180);
            dots.forEach((d, idx) => {
                const a = idx === i;
                d.classList.toggle('w-3.5', a); d.classList.toggle('h-3.5', a); d.classList.toggle('bg-brand', a);
                d.classList.toggle('w-3', !a); d.classList.toggle('h-3', !a); d.classList.toggle('bg-white/25', !a);
            });
        }
        function restart() { clearInterval(timer); timer = setInterval(() => select((cur + 1) % data.length), 4500); }

        dots.forEach((d, i) => d.addEventListener('click', () => { select(i); restart(); }));
        restart();
    })();
</script>
@endpush
