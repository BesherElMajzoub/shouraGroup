@extends('layouts.app')

@section('title', 'الأخبار | مجموعة شورى')
@section('description', 'تابع آخر مستجدات وأخبار مجموعة شورى السورية، إنجازاتنا، مشاريعنا الجديدة، وشراكاتنا الإستراتيجية في مجالات المياه والمسابح والمقاولات.')

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => 'الأخبار',
        'eyebrow' => 'كن على اطلاع بآخر مستجداتنا',
        'title'   => 'المركز الإعلامي والأخبار',
        'desc'    => 'نشارككم نجاحاتنا وإنجازاتنا خطوة بخطوة، ونستعرض معكم أهم الفعاليات والشراكات التي تساهم في تطوير وتوسيع خدماتنا في سوريا.',
    ])

    {{-- ===== NEWS INDEX SECTION WITH FILTER ===== --}}
    @php
        $categories = [
            ['id' => 'all', 'label' => 'كل الأخبار'],
            ['id' => 'projects', 'label' => 'أخبار المشاريع'],
            ['id' => 'partnerships', 'label' => 'شراكات وتوريد'],
            ['id' => 'achievements', 'label' => 'إنجازات وفعاليات'],
        ];

        $news = [
            [
                'cat' => 'projects',
                'date' => '12 حزيران 2026',
                'title' => 'شورى تنجز محطة تحلية مياه جديدة في ريف دمشق',
                'desc' => 'أتمّت مجموعة شورى تنفيذ وتشغيل محطة تحلية ومعالجة مياه جديدة بطاقة إنتاجية عالية لتوفير مياه صالحة للشرب تخدم التجمعات السكنية والصناعية بالمنطقة.',
                'img' => 'industrial_bg.png'
            ],
            [
                'cat' => 'partnerships',
                'date' => '28 أيار 2026',
                'title' => 'توقيع اتفاقية توريد معدات مسابح مع علامة تجارية عالمية',
                'desc' => 'وقّعت شورى للمسابح اتفاقية شراكة استراتيجية لتوريد أحدث أنظمة الفلترة الميكانيكية والتعقيم الملحي والمضخات الحرارية لتقديمها لعملائنا في السوق السوري.',
                'img' => 'about_skyscrapers.png'
            ],
            [
                'cat' => 'achievements',
                'date' => '10 أيار 2026',
                'title' => 'افتتاح مكتب إقليمي ووحدة دعم فني جديدة للمجموعة في حلب',
                'desc' => 'تسهيلاً لخدمة عملائنا في المنطقة الشمالية، افتتحت مجموعة شورى وحدة متكاملة لتقديم الاستشارات الفنية وقطع الغيار وخدمات الصيانة الفورية بحلب.',
                'img' => 'saudi_map.png'
            ],
            [
                'cat' => 'achievements',
                'date' => '22 نيسان 2026',
                'title' => 'مشاركة مميزة لمجموعة شورى في معرض البناء السوري (TechnoBuild)',
                'desc' => 'استعرضت المجموعة أحدث الحلول البيئية لمعالجة مياه الصرف الصحي وأنظمة توفير الطاقة للمسابح، وقد شهد الجناح إقبالاً واسعاً من المهندسين والمطورين.',
                'img' => 'industrial_bg.png'
            ],
            [
                'cat' => 'projects',
                'date' => '05 نيسان 2026',
                'title' => 'البدء بتنفيذ شبكة المياه والصرف لمشروع ضاحية الياسمين السكنية',
                'desc' => 'باشرت كوادر شورى للمقاولات أعمال الحفر والتمديد لشبكات المياه والصرف وتصريف السيول لصالح مشروع الضاحية السكنية الجديدة بجودة إنشائية معتمدة.',
                'img' => 'about_skyscrapers.png'
            ],
            [
                'cat' => 'achievements',
                'date' => '15 آذار 2026',
                'title' => 'مجموعة شورى تحصل على شهادة الجودة العالمية ISO 9001:2015',
                'desc' => 'تتويجاً لجهود فرق العمل في الالتزام بأعلى معايير الإدارة الهندسية وجودة الخدمات الفنية والتنفيذية، نلنا بفخر الاعتماد الدولي لنظام إدارة الجودة.',
                'img' => 'saudi_map.png'
            ],
        ];
    @endphp

    <section class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            
            {{-- Search & Categories --}}
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 pb-12 border-b border-gray-100">
                <div class="flex flex-wrap items-center gap-2 justify-center md:justify-start">
                    @foreach ($categories as $cat)
                        <button type="button" 
                                onclick="filterNews('{{ $cat['id'] }}', this)" 
                                class="news-cat-btn px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300
                                       {{ $cat['id'] === 'all' ? 'bg-brand text-white shadow-lg shadow-brand/20' : 'bg-[#f7f7f8] text-[#4b4b4b] hover:bg-gray-200' }}">
                            {{ $cat['label'] }}
                        </button>
                    @endforeach
                </div>
                
                <div class="relative w-full max-w-xs shrink-0">
                    <input type="text" id="newsSearchInput" onkeyup="searchNews()" placeholder="ابحث في الأخبار..." 
                           class="w-full bg-[#f7f7f8] rounded-xl px-5 py-3 pr-11 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                    <svg class="absolute right-4 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.637 10.637Z"/></svg>
                </div>
            </div>

            {{-- News Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 pt-12" id="newsGrid">
                @foreach ($news as $i => $n)
                    <article class="reveal news-card group bg-white rounded-2xl overflow-hidden shadow-sm ring-1 ring-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
                             data-category="{{ $n['cat'] }}"
                             data-title="{{ mb_strtolower($n['title']) }}"
                             data-desc="{{ mb_strtolower($n['desc']) }}"
                             style="transition-delay:{{ $i * 0.05 }}s">
                        
                        {{-- Image --}}
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('images/' . $n['img']) }}" alt="{{ $n['title'] }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 right-4 bg-brand text-white text-xs font-bold rounded-full px-3 py-1 shadow-md">
                                @if($n['cat'] === 'projects') مشاريع @elseif($n['cat'] === 'partnerships') شراكات @else إنجازات @endif
                            </span>
                        </div>

                        {{-- Body --}}
                        <div class="p-6 text-right">
                            <div class="flex items-center gap-2 text-xs text-gray-400 mb-3 justify-start dir-rtl">
                                <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                <span>{{ $n['date'] }}</span>
                            </div>
                            
                            <h3 class="news-card-title text-lg font-bold text-[#141414] mb-3 leading-snug group-hover:text-brand transition-colors">{{ $n['title'] }}</h3>
                            <p class="text-[#4b4b4b] text-sm leading-relaxed mb-5 h-20 overflow-hidden line-clamp-3">{{ $n['desc'] }}</p>
                            
                            <div class="border-t border-gray-100 pt-4">
                                <a href="{{ url('/contact') }}?subject={{ urlencode('استفسار بخصوص خبر: ' . $n['title']) }}" 
                                   class="inline-flex items-center gap-1 text-brand font-bold text-sm hover:gap-2 transition-all">
                                    تواصل معنا بخصوص هذا الخبر
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ===== NEWSLETTER SIGNUP SECTION ===== --}}
    <section class="py-20 bg-[#141414] text-white relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.05]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>
        
        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 text-center reveal">
            <h2 class="text-2xl sm:text-3xl font-black mb-4">اشترك في نشرتنا البريدية</h2>
            <p class="text-white/70 mb-8 max-w-lg mx-auto">كن أول من يعلم بالمشاريع الجديدة، فرص التوظيف المستقبلية، والشراكات الحصرية لمجموعة شورى في سوريا.</p>
            
            <div id="newsletterSuccess" class="hidden mb-6 p-4 rounded-xl bg-green-900/50 text-green-200 text-sm font-bold text-center border border-green-800 max-w-md mx-auto">
                تهانينا! لقد تم تسجيل بريدك الإلكتروني بنجاح في قائمتنا الإخبارية.
            </div>

            <form id="newsletterForm" onsubmit="handleNewsletterSubmit(event)" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                <input type="email" id="newsletterEmail" required placeholder="أدخل بريدك الإلكتروني..." 
                       class="flex-1 bg-white/10 rounded-xl px-5 py-3.5 text-sm text-white focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white/20 transition-all text-right">
                
                <button type="submit" id="newsSubBtn" class="bg-brand hover:bg-brand-dark text-white px-7 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                    اشترك الآن
                </button>
            </form>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    function filterNews(catId, button) {
        // Update active class on buttons
        document.querySelectorAll('.news-cat-btn').forEach(btn => {
            btn.className = "news-cat-btn px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 bg-[#f7f7f8] text-[#4b4b4b] hover:bg-gray-200";
        });
        button.className = "news-cat-btn px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 bg-brand text-white shadow-lg shadow-brand/20";

        // Show/hide cards based on category
        const cards = document.querySelectorAll('.news-card');
        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (catId === 'all' || cardCat === catId) {
                card.style.display = 'block';
                card.classList.add('in-view');
            } else {
                card.style.display = 'none';
            }
        });
    }

    function searchNews() {
        const query = document.getElementById('newsSearchInput').value.toLowerCase().trim();
        const cards = document.querySelectorAll('.news-card');
        
        cards.forEach(card => {
            const title = card.getAttribute('data-title');
            const desc = card.getAttribute('data-desc');
            
            // Check active category button
            const activeBtn = document.querySelector('.news-cat-btn.bg-brand');
            const selectedCat = activeBtn.textContent.trim();
            
            let catId = 'all';
            if (selectedCat.includes('المشاريع')) catId = 'projects';
            else if (selectedCat.includes('شراكات')) catId = 'partnerships';
            else if (selectedCat.includes('إنجازات')) catId = 'achievements';

            const cardCat = card.getAttribute('data-category');
            const matchesCat = (catId === 'all' || cardCat === catId);
            
            if (matchesCat && (title.includes(query) || desc.includes(query))) {
                card.style.display = 'block';
                card.classList.add('in-view');
            } else {
                card.style.display = 'none';
            }
        });
    }

    function handleNewsletterSubmit(event) {
        event.preventDefault();
        
        const subBtn = document.getElementById('newsSubBtn');
        const successBox = document.getElementById('newsletterSuccess');
        const form = document.getElementById('newsletterForm');
        
        subBtn.disabled = true;
        subBtn.textContent = 'جاري التسجيل...';
        
        setTimeout(() => {
            successBox.classList.remove('hidden');
            form.reset();
            subBtn.disabled = false;
            subBtn.textContent = 'اشترك الآن';
        }, 1000);
    }
</script>
@endpush
