@extends('layouts.app')

@section('title', 'الأخبار | شورى إخوان')
@section('description', 'تابع آخر مستجدات شورى إخوان: الوكالات والمنتجات الجديدة، المشاريع المنجزة، والفعاليات في مختلف قطاعاتنا الهندسية.')

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => 'الأخبار',
        'eyebrow' => 'كن على اطلاع بآخر مستجداتنا',
        'title'   => 'المركز الإعلامي والأخبار',
        'desc'    => 'نشارككم أحدث وكالاتنا ومنتجاتنا وإنجازاتنا خطوة بخطوة، ونستعرض معكم أهم الفعاليات والشراكات التي تساهم في تطوير وتوسيع خدماتنا في سوريا.',
    ])

    {{-- ===== NEWS INDEX SECTION WITH FILTER ===== --}}
    <section class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            
            {{-- Search & Categories --}}
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 pb-12 border-b border-gray-100">
                <div class="flex flex-wrap items-center gap-2 justify-center md:justify-start">
                    <button type="button" 
                            onclick="filterNews('all', this)" 
                            class="news-cat-btn px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 bg-brand text-white shadow-lg shadow-brand/20">
                        كل الأخبار
                    </button>
                    @foreach ($categories as $cat)
                        <button type="button" 
                                onclick="filterNews('{{ $cat->slug }}', this)" 
                                class="news-cat-btn px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 bg-[#f7f7f8] text-[#4b4b4b] hover:bg-gray-200">
                            {{ $cat->name }}
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
                             data-category="{{ $n->category->slug }}"
                             data-title="{{ mb_strtolower($n->title) }}"
                             data-desc="{{ mb_strtolower($n->excerpt) }}"
                             style="transition-delay:{{ $i * 0.05 }}s">
                        
                        {{-- Image --}}
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $n->image_url }}" alt="{{ $n->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 right-4 bg-brand text-white text-xs font-bold rounded-full px-3 py-1 shadow-md">
                                {{ $n->category->name }}
                            </span>
                        </div>

                        {{-- Body --}}
                        <div class="p-6 text-right">
                            <div class="flex items-center gap-2 text-xs text-gray-400 mb-3 justify-start dir-rtl">
                                <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                <span>{{ $n->published_at ? $n->published_at->translatedFormat('j F Y') : '' }}</span>
                            </div>
                            
                            <h3 class="news-card-title text-lg font-bold text-[#141414] mb-3 leading-snug group-hover:text-brand transition-colors">
                                <a href="{{ route('news.show', $n->slug) }}">{{ $n->title }}</a>
                            </h3>
                            <p class="text-[#4b4b4b] text-sm leading-relaxed mb-5 h-20 overflow-hidden line-clamp-3">{{ $n->excerpt }}</p>
                            
                            <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                                <a href="{{ route('news.show', $n->slug) }}" 
                                   class="inline-flex items-center gap-1 text-brand font-bold text-sm hover:gap-2 transition-all">
                                    اقرأ المزيد
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12 flex justify-center">
                {{ $news->links() }}
            </div>
        </div>
    </section>

    {{-- ===== NEWSLETTER SIGNUP SECTION ===== --}}
    <section class="py-20 bg-[#141414] text-white relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.05]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>
        
        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 text-center reveal">
            <h2 class="text-2xl sm:text-3xl font-black mb-4">اشترك في نشرتنا البريدية</h2>
            <p class="text-white/70 mb-8 max-w-lg mx-auto">كن أول من يعلم بالوكالات والمنتجات الجديدة، المشاريع المنجزة، والشراكات الحصرية لشورى إخوان في سوريا.</p>
            
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
