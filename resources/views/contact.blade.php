@extends('layouts.app')

@section('title', 'تواصل معنا | مجموعة شورى')
@section('description', 'اتصل بمجموعة شورى للحصول على الدعم الفني، مبيعات محطات تحلية المياه والمسابح والمقاولات في سوريا. اتصل بنا أو راسلنا عبر استمارة التواصل.')

@section('content')

    @php
        // أقسام الشركة — لكل قسم بريد إلكتروني خاص (استبدل العناوين بالبريد الرسمي لكل قسم)
        $departments = [
            ['name' => 'استفسار عام',                    'email' => 'info@shora-group.sy'],
            ['name' => 'قسم معالجة وتحلية المياه',        'email' => 'water@shora-group.sy'],
            ['name' => 'قسم المسابح والبحيرات',           'email' => 'pools@shora-group.sy'],
            ['name' => 'قسم المقاولات والإنشاءات',        'email' => 'contracting@shora-group.sy'],
            ['name' => 'قسم الصيانة والتشغيل',            'email' => 'maintenance@shora-group.sy'],
            ['name' => 'قسم التجارة والتوريد',            'email' => 'sales@shora-group.sy'],
            ['name' => 'قسم الاستشارات الهندسية',         'email' => 'consulting@shora-group.sy'],
            ['name' => 'الدعم الفني',                     'email' => 'support@shora-group.sy'],
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
                <span class="text-[#141414] font-medium">تواصل معنا</span>
            </nav>
            <span class="inline-block text-brand font-bold text-xs tracking-widest uppercase mb-3">يسعدنا دائماً سماع صوتك</span>
            <h1 class="text-3xl sm:text-4xl font-black text-[#141414] mb-3">تواصل معنا</h1>
            <p class="max-w-xl text-[#555] leading-loose text-[15px]">
                هل لديك استفسار، طلب عرض أسعار، أو بحاجة لدعم فني؟ تواصل معنا اليوم وسيقوم فريقنا المختص بالرد عليك في أسرع وقت ممكن.
            </p>
        </div>
    </section>

    {{-- ===== CONTACT CONTENT SECTION ===== --}}
    <section class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-16">
                
                {{-- Contact Info Column (Right) --}}
                <div class="lg:col-span-5 space-y-8 text-right order-2 lg:order-1">
                    <div class="space-y-4">
                        <span class="inline-block text-brand font-bold text-sm">معلومات الاتصال المباشر</span>
                        <h2 class="text-2xl sm:text-3xl font-black text-[#141414]">لا تتردد في الاتصال بنا</h2>
                        <p class="text-[#4b4b4b] text-sm leading-relaxed">يمكنك التواصل معنا مباشرة عبر الأرقام الرسمية أو البريد الإلكتروني، أو زيارة أحد مكاتبنا خلال أوقات الدوام الرسمي.</p>
                    </div>

                    <div class="space-y-5">
                        {{-- Phone Info --}}
                        <div class="flex items-start gap-4 p-5 rounded-2xl bg-gray-50 ring-1 ring-black/5">
                            <span class="shrink-0 w-12 h-12 rounded-xl bg-brand text-white grid place-items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-[#141414] mb-1">الهاتف الموحد</h3>
                                <a href="tel:+963112345678" class="text-sm text-[#4b4b4b] hover:text-brand transition-colors block" dir="ltr">+963 11 234 5678</a>
                                <a href="tel:+963118765432" class="text-sm text-[#4b4b4b] hover:text-brand transition-colors block" dir="ltr">+963 11 876 5432</a>
                            </div>
                        </div>

                        {{-- Email Info --}}
                        <div class="flex items-start gap-4 p-5 rounded-2xl bg-gray-50 ring-1 ring-black/5">
                            <span class="shrink-0 w-12 h-12 rounded-xl bg-brand text-white grid place-items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-[#141414] mb-1">البريد الإلكتروني</h3>
                                <a href="mailto:info@shora-group.sy" class="text-sm text-[#4b4b4b] hover:text-brand transition-colors block">info@shora-group.sy</a>
                                <a href="mailto:support@shora-group.sy" class="text-sm text-[#4b4b4b] hover:text-brand transition-colors block">support@shora-group.sy</a>
                            </div>
                        </div>

                        {{-- Location Info --}}
                        <div class="flex items-start gap-4 p-5 rounded-2xl bg-gray-50 ring-1 ring-black/5">
                            <span class="shrink-0 w-12 h-12 rounded-xl bg-brand text-white grid place-items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-[#141414] mb-1">المكتب الرئيسي</h3>
                                <p class="text-sm text-[#4b4b4b]">دمشق، ساحة المرجة، بناية مجموعة شورى، سوريا</p>
                            </div>
                        </div>

                        {{-- Working Hours Info --}}
                        <div class="flex items-start gap-4 p-5 rounded-2xl bg-gray-50 ring-1 ring-black/5">
                            <span class="shrink-0 w-12 h-12 rounded-xl bg-brand text-white grid place-items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-[#141414] mb-1">أوقات العمل الرسمية</h3>
                                <p class="text-sm text-[#4b4b4b]">الأحد - الخميس: 9:00 صباحاً حتى 5:00 مساءً</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Form Column (Left) --}}
                <div class="lg:col-span-7 order-1 lg:order-2 reveal bg-white p-8 sm:p-10 rounded-[2.5rem] shadow-lg ring-1 ring-black/5">
                    <span class="inline-block text-brand font-bold text-sm mb-3">راسلنا مباشرة</span>
                    <h2 class="text-2xl font-black text-[#141414] mb-8 text-right">أرسل رسالة سريعة</h2>

                    {{-- Form Success Alert --}}
                    <div id="formSuccess" class="hidden mb-6 p-4 rounded-xl bg-green-50 text-green-800 text-sm font-bold text-right border border-green-200">
                        شكراً لك! تم استلام رسالتك بنجاح. سيقوم أحد مهندسينا بالتواصل معك في غضون 24 ساعة.
                    </div>

                    {{-- Form --}}
                    <form id="contactForm" onsubmit="handleContactSubmit(event)" class="space-y-6 text-right">
                        {{-- Department selector --}}
                        <div>
                            <label for="department" class="block text-xs font-bold text-[#141414] mb-2">القسم المختص <span class="text-brand">*</span></label>
                            <div class="relative">
                                <select id="department" required onchange="updateDeptEmail()"
                                        style="-webkit-appearance:none; -moz-appearance:none; appearance:none;"
                                        class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 pl-10 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                                    @foreach ($departments as $i => $dept)
                                        <option value="{{ $dept['email'] }}" data-name="{{ $dept['name'] }}" {{ $i === 0 ? 'selected' : '' }}>{{ $dept['name'] }}</option>
                                    @endforeach
                                </select>
                                <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                            </div>
                            {{-- Department email preview (shown before sending) --}}
                            <div id="deptEmailBox" class="mt-2.5 flex flex-wrap items-center gap-x-2 gap-y-1 rounded-xl px-4 py-2.5 text-sm"
                                 style="background:rgba(225,29,38,.05); border:1px solid rgba(225,29,38,.15);">
                                <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                                <span class="text-[#4b4b4b]">سيصل طلبك إلى بريد القسم:</span>
                                <a id="deptEmailLink" href="#" class="font-bold text-brand hover:underline" dir="ltr"></a>
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-6">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-xs font-bold text-[#141414] mb-2">الاسم الكامل <span class="text-brand">*</span></label>
                                <input type="text" id="name" required 
                                       class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label for="phone" class="block text-xs font-bold text-[#141414] mb-2">رقم الهاتف <span class="text-brand">*</span></label>
                                <input type="tel" id="phone" required placeholder="09xxxxxxxx"
                                       class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all text-left" dir="ltr">
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-6">
                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-xs font-bold text-[#141414] mb-2">البريد الإلكتروني</label>
                                <input type="email" id="email" 
                                       class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all text-left" dir="ltr">
                            </div>

                            {{-- Subject --}}
                            <div>
                                <label for="subject" class="block text-xs font-bold text-[#141414] mb-2">الموضوع / نوع الاستفسار <span class="text-brand">*</span></label>
                                <input type="text" id="subject" required 
                                       class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                            </div>
                        </div>

                        {{-- Message --}}
                        <div>
                            <label for="message" class="block text-xs font-bold text-[#141414] mb-2">نص الرسالة / تفاصيل طلبك <span class="text-brand">*</span></label>
                            <textarea id="message" rows="5" required 
                                      class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all resize-none"></textarea>
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-2">
                            <button type="submit" id="submitBtn" 
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-brand hover:bg-brand-dark text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                                إرسال الرسالة الآن
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </section>

    {{-- ===== EMBEDDED MAP SECTION ===== --}}
    <section class="reveal relative h-96 w-full bg-gray-100 overflow-hidden">
        {{-- OpenStreetMap centered on Al-Marjeh area, Damascus, Syria --}}
        <iframe class="w-full h-full border-0 grayscale hover:grayscale-0 transition-all duration-700" 
                src="https://www.openstreetmap.org/export/embed.html?bbox=36.29158639907838%2C33.51034455850974%2C36.30310893058778%2C33.51817462002361&amp;layer=mapnik&amp;marker=33.51426027055743%2C36.29734766483307" 
                allowfullscreen="" 
                loading="lazy"></iframe>
    </section>

@endsection

@push('scripts')
<script>
    // Show the selected department's email in the preview box before sending
    function updateDeptEmail() {
        const select = document.getElementById('department');
        const link = document.getElementById('deptEmailLink');
        if (!select || !link) return;
        const email = select.value;
        link.textContent = email;
        link.href = 'mailto:' + email;
    }

    // Extract query parameters to pre-populate subject/message fields
    document.addEventListener("DOMContentLoaded", () => {
        updateDeptEmail();

        const params = new URLSearchParams(window.location.search);
        const service = params.get('service');
        const product = params.get('product');
        const project = params.get('project');
        const subject = params.get('subject');
        const department = params.get('department');

        const subjectInput = document.getElementById('subject');
        const messageTextarea = document.getElementById('message');

        // Pre-select a department if it matches one coming from the query string
        if (department) {
            const select = document.getElementById('department');
            const match = [...select.options].find(o => o.dataset.name === decodeURIComponent(department));
            if (match) { select.value = match.value; updateDeptEmail(); }
        }

        if (service) {
            subjectInput.value = `استفسار حول خدمة: ${decodeURIComponent(service)}`;
            messageTextarea.placeholder = `يرجى كتابة تفاصيل مشروعك أو الخدمة المطلوبة: ${decodeURIComponent(service)} هنا...`;
        } else if (product) {
            subjectInput.value = `طلب استفسار عن منتج: ${decodeURIComponent(product)}`;
            messageTextarea.placeholder = `أود الاستفسار عن توفر وسعر منتج: ${decodeURIComponent(product)}...`;
        } else if (project) {
            subjectInput.value = `استعلام عن مشروع: ${decodeURIComponent(project)}`;
            messageTextarea.placeholder = `أود معرفة تفاصيل فنية بخصوص مشروع: ${decodeURIComponent(project)}...`;
        } else if (subject) {
            subjectInput.value = decodeURIComponent(subject);
        }
    });

    // Mock form submit function
    function handleContactSubmit(event) {
        event.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
        const formSuccess = document.getElementById('formSuccess');
        const form = document.getElementById('contactForm');
        
        // Disable button and change text to sending
        submitBtn.disabled = true;
        submitBtn.innerHTML = `جاري الإرسال...`;
        
        setTimeout(() => {
            // Show success message including the chosen department email
            const select = document.getElementById('department');
            const deptName = select.options[select.selectedIndex].dataset.name;
            const deptEmail = select.value;
            formSuccess.innerHTML = `شكراً لك! تم استلام رسالتك بنجاح وتوجيهها إلى <span class="font-black">${deptName}</span> (<span dir="ltr">${deptEmail}</span>). سيقوم أحد مهندسينا بالتواصل معك في غضون 24 ساعة.`;
            formSuccess.classList.remove('hidden');
            form.reset();
            updateDeptEmail();
            
            // Re-enable button
            submitBtn.disabled = false;
            submitBtn.innerHTML = `إرسال الرسالة الآن <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>`;
            
            // Scroll to success message
            formSuccess.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 1200);
    }
</script>
@endpush
