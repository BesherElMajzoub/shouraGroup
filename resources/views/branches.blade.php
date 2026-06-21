@extends('layouts.app')

@section('title', 'فروع الشركة | مجموعة شورى')
@section('description', 'تواصل مع فروع مجموعة شورى المنتشرة في سوريا (دمشق، حلب، حمص، اللاذقية) للتعرف على مواقع المكاتب الرسمية وخدمات الدعم الفني والمبيعات.')

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => 'فروع الشركة',
        'eyebrow' => 'حضور قوي وقريب منك دائماً',
        'title'   => 'فروعنا ووحداتنا',
        'desc'    => 'نسعى دائماً لنكون بالقرب من عملائنا في مختلف المحافظات السورية لتقديم خدمات الدعم الفني، المبيعات، والاستشارات الهندسية بكفاءة عالية وسرعة استجابة.',
    ])

    {{-- ===== MAP & BRANCHES SECTION ===== --}}
    @php
        $branches = [
            [
                'name' => 'الإدارة العامة ووحدة دمشق (المرجة)',
                'addr' => 'دمشق، ساحة المرجة - بناية مجموعة شورى، الطابق الثاني',
                'phone' => '+963 11 234 5678',
                'fax' => '+963 11 234 5679',
                'email' => 'damascus@shora-group.sy',
                'hours' => 'الأحد - الخميس: 9:00 صباحاً - 5:00 مساءً',
                'map_link' => 'https://maps.google.com',
                'top' => 78,
                'left' => 9
            ],
            [
                'name' => 'وحدة برامكة – الجمارك',
                'addr' => 'دمشق، البرامكة - قرب ساحة الجمارك، خلف وكالة الأنباء سانا',
                'phone' => '+963 11 876 5432',
                'fax' => '+963 11 876 5433',
                'email' => 'baramkeh@shora-group.sy',
                'hours' => 'الأحد - الخميس: 9:00 صباحاً - 5:00 مساءً',
                'map_link' => 'https://maps.google.com',
                'top' => 64,
                'left' => 15
            ],
            [
                'name' => 'وحدة حلب – الجميلية',
                'addr' => 'حلب، حي الجميلية - شارع فيصل، مقابل فرع نقابة المهندسين',
                'phone' => '+963 21 345 6789',
                'fax' => '+963 21 345 6790',
                'email' => 'aleppo@shora-group.sy',
                'hours' => 'الأحد - الخميس: 9:00 صباحاً - 4:30 مساءً',
                'map_link' => 'https://maps.google.com',
                'top' => 25,
                'left' => 45
            ],
            [
                'name' => 'وحدة حمص – الدبلان',
                'addr' => 'حمص، شارع الدبلان التجاري - برج الياسمين، الطابق الأول',
                'phone' => '+963 31 456 7890',
                'fax' => '+963 31 456 7891',
                'email' => 'homs@shora-group.sy',
                'hours' => 'الأحد - الخميس: 9:00 صباحاً - 4:30 مساءً',
                'map_link' => 'https://maps.google.com',
                'top' => 58,
                'left' => 32
            ],
            [
                'name' => 'وحدة اللاذقية – الكورنيش الغربي',
                'addr' => 'اللاذقية، الكورنيش الغربي - مقابل المرفأ، بناء النورس البحري',
                'phone' => '+963 41 567 8901',
                'fax' => '+963 41 567 8902',
                'email' => 'lattakia@shora-group.sy',
                'hours' => 'الأحد - الخميس: 9:00 صباحاً - 4:00 مساءً',
                'map_link' => 'https://maps.google.com',
                'top' => 48,
                'left' => 10
            ],
        ];
    @endphp

    <section class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            
            <div class="grid lg:grid-cols-12 gap-16 items-center">
                
                {{-- Interactive Map (SVG with relative pins) --}}
                <div class="lg:col-span-6 order-2 lg:order-1 reveal">
                    <div class="relative w-full max-w-lg mx-auto bg-gray-50 rounded-[2.5rem] p-6 shadow-sm ring-1 ring-black/5" style="aspect-ratio:659/600;">
                        <img src="{{ asset('images/syria-map.svg') }}" alt="خريطة سوريا" class="w-full h-full object-contain">
                        
                        @foreach ($branches as $i => $b)
                            <div class="absolute -translate-x-1/2 -translate-y-full group cursor-pointer"
                                 style="top:{{ $b['top'] }}%; left:{{ $b['left'] }}%;"
                                 onclick="focusBranch({{ $i }})">
                                <span class="absolute left-1/2 -translate-x-1/2 bottom-1 w-4 h-4 rounded-full bg-brand anim-ping"></span>
                                <svg class="relative w-9 h-9 text-brand drop-shadow-lg anim-float" style="animation-delay:{{ $i*0.6 }}s" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2a7 7 0 0 0-7 7c0 5 7 13 7 13s7-8 7-13a7 7 0 0 0-7-7Z"/>
                                    <circle cx="12" cy="9" r="2.6" fill="#fff"/>
                                </svg>
                                <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1 whitespace-nowrap
                                             bg-[#141414] text-white text-[11px] font-bold rounded-md px-2 py-1 shadow-lg opacity-80 group-hover:opacity-100 transition-opacity">{{ $b['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Branches Details List --}}
                <div class="lg:col-span-6 order-1 lg:order-2 space-y-6">
                    <h2 class="text-3xl font-black text-[#141414] mb-4 text-right">عناوين وهواتف مكاتبنا</h2>
                    
                    <div class="space-y-4 max-h-[550px] overflow-y-auto pr-2" id="branchesList">
                        @foreach ($branches as $i => $b)
                            <div class="branch-card reveal bg-white rounded-2xl shadow-md ring-1 ring-black/5 p-6 flex flex-col sm:flex-row items-start gap-4 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300"
                                 data-index="{{ $i }}"
                                 style="transition-delay:{{ $i*0.1 }}s">
                                
                                <span class="shrink-0 w-12 h-12 rounded-xl bg-brand text-white grid place-items-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/>
                                        <circle cx="12" cy="9" r="2.5"/>
                                    </svg>
                                </span>
                                
                                <div class="flex-1 space-y-2 text-right">
                                    <h3 class="text-lg font-bold text-[#141414]">{{ $b['name'] }}</h3>
                                    
                                    <p class="flex items-start gap-2 text-sm text-[#4b4b4b] leading-relaxed">
                                        <svg class="w-4 h-4 text-brand shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                        {{ $b['addr'] }}
                                    </p>
                                    
                                    <div class="grid sm:grid-cols-2 gap-2 text-xs text-[#4b4b4b]">
                                        <a href="tel:{{ str_replace(' ', '', $b['phone']) }}" class="flex items-center gap-2 hover:text-brand transition-colors">
                                            <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                                            <span dir="ltr">{{ $b['phone'] }}</span>
                                        </a>
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12h19.5M2.25 12a1.5 1.5 0 1 1-3 0M2.25 12a1.5 1.5 0 1 0-3 0M21.25 12a1.5 1.5 0 1 1-3 0M21.25 12a1.5 1.5 0 1 0-3 0"/></svg>
                                            <span dir="ltr">فاكس: {{ $b['fax'] }}</span>
                                        </span>
                                        <a href="mailto:{{ $b['email'] }}" class="flex items-center gap-2 hover:text-brand transition-colors col-span-2">
                                            <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                                            {{ $b['email'] }}
                                        </a>
                                        <span class="flex items-center gap-2 col-span-2">
                                            <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                            {{ $b['hours'] }}
                                        </span>
                                    </div>
                                    
                                    <div class="pt-3">
                                        <a href="{{ $b['map_link'] }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-brand font-bold hover:underline">
                                            عرض الاتجاهات على الخريطة
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== CUSTOMER ASSISTANCE CTA ===== --}}
    <section class="py-16 bg-[#141414] text-white relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.05]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>
        
        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 text-center">
            <h2 class="text-2xl sm:text-3xl font-black mb-4">هل تحتاج إلى زيارة ميدانية من خبرائنا لموقعك؟</h2>
            <p class="text-white/70 mb-8 max-w-xl mx-auto">لدينا فِرق دعم فني متنقلة ومستعدة لزيارة منشأتك أو عقارك لمعاينة وفحص المياه، أو الكشف الفني على حمامات السباحة ومعدات الفلترة.</p>
            <a href="{{ url('/contact') }}?subject={{ urlencode('طلب زيارة فنية كشف') }}" 
               class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                حجز موعد كشف فني
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            </a>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    function focusBranch(index) {
        // Highlight active branch card
        const cards = document.querySelectorAll('.branch-card');
        
        cards.forEach((card, i) => {
            if (i === index) {
                card.classList.add('ring-2', 'ring-brand', 'bg-red-50/10');
                card.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                card.classList.remove('ring-2', 'ring-brand', 'bg-red-50/10');
            }
        });
    }
</script>
@endpush
