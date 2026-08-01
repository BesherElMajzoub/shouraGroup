@extends('layouts.app')

@section('title', 'انضم إلى فريقنا | شورى إخوان')
@section('description', 'فرص العمل في شورى إخوان — المبيعات والتسويق، الهندسة ودراسة المناقصات، الدعم الفني والصيانة، الإدارة والمحاسبة، والمستودعات.')

@section('content')

    @php
        $departments = [
            'المبيعات والتسويق (مندوبون، مديرو حسابات، مبيعات صالات)',
            'الهندسة ودراسة المناقصات',
            'الدعم الفني والصيانة (فنيو مضخات، مولدات، ضواغط)',
            'الإدارة والمحاسبة',
            'المستودعات والخدمات اللوجستية',
        ];
    @endphp

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => 'انضم إلى فريقنا',
        'eyebrow' => 'فرص عمل',
        'title'   => 'شركاء في بناء المستقبل – انضم إلى عائلة شورى إخوان',
        'desc'    => $careers_intro,
    ])

    {{-- ===== WHY WORK WITH US ===== --}}
    <section class="py-20 lg:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">بيئة العمل لدينا</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">لماذا تعمل معنا؟</h2>
            </div>

            @php
                $perks = [
                    [
                        'title' => 'التطوير المستمر',
                        'desc' => 'احتكاك مباشر مع أحدث التقنيات الهندسية الأوروبية والآسيوية.',
                        'icon' => 'M9.663 17h4.673M12 3v1m6.364.364-.707.707M21 12h-1M4 12H3m3.343-5.657-.707-.707m2.828 9.9a5 5 0 1 1 7.072 0l-.548.547A3.374 3.374 0 0 0 14 18.469V19a2 2 0 1 1-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547Z',
                    ],
                    [
                        'title' => 'الاستقرار المهني',
                        'desc' => 'بيئة عمل مؤسساتية تقدّر الكفاءة وتدعم الاستقرار الوظيفي والتطور.',
                        'icon' => 'M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6',
                    ],
                    [
                        'title' => 'التوسع الجغرافي',
                        'desc' => 'فرص عمل تتوزع بين إداراتنا وصالاتنا في دمشق وحلب.',
                        'icon' => 'M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z',
                    ],
                ];
            @endphp

            <div class="grid sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
                @foreach ($perks as $i => $p)
                    <div class="reveal text-center bg-[#f7f7f8] rounded-2xl p-8 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                         style="transition-delay:{{ $i * 0.08 }}s">
                        <div class="w-16 h-16 mx-auto rounded-2xl bg-brand text-white grid place-items-center mb-5">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $p['icon'] }}"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-[#141414] mb-2">{{ $p['title'] }}</h3>
                        <p class="text-[#4b4b4b] text-sm leading-relaxed">{{ $p['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== APPLICATION FORM ===== --}}
    <section id="apply" class="scroll-mt-24 py-20 lg:py-24 bg-[#f7f7f8] relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.03]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-3xl px-4 sm:px-6">
            <div class="text-center mb-10 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">نموذج طلب التوظيف</span>
                <h2 class="text-2xl sm:text-3xl font-black text-[#141414] mb-3">قدّم طلبك الآن</h2>
                <p class="text-[#4b4b4b] text-sm">يرجى تعبئة الحقول بدقة وإرفاق سيرتك الذاتية.</p>
            </div>

            <div class="reveal bg-white p-7 sm:p-10 rounded-[2rem] shadow-lg ring-1 ring-black/5">
                <div id="cvSuccess" class="hidden mb-6 p-4 rounded-xl bg-green-50 text-green-800 text-sm font-bold text-right border border-green-200"></div>
                <div id="cvError" class="hidden mb-6 p-4 rounded-xl bg-red-50 text-red-800 text-sm font-bold text-right border border-red-200"></div>

                <form id="cvForm" class="space-y-6 text-right">
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="c_name" class="block text-xs font-bold text-[#141414] mb-2">الاسم الثلاثي <span class="text-brand">*</span></label>
                            <input type="text" id="c_name" required
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                        </div>
                        <div>
                            <label for="c_phone" class="block text-xs font-bold text-[#141414] mb-2">رقم الهاتف المحمول <span class="text-brand">*</span></label>
                            <input type="tel" id="c_phone" required placeholder="09xxxxxxxx" dir="ltr"
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] text-left focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="c_email" class="block text-xs font-bold text-[#141414] mb-2">البريد الإلكتروني <span class="text-gray-400 font-normal">(اختياري)</span></label>
                        <input type="email" id="c_email" dir="ltr"
                               class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] text-left focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                    </div>

                    <div>
                        <label for="c_dept" class="block text-xs font-bold text-[#141414] mb-2">القسم أو المجال الوظيفي المفضل <span class="text-brand">*</span></label>
                        <div class="relative">
                            <select id="c_dept" required
                                    style="-webkit-appearance:none; -moz-appearance:none; appearance:none;"
                                    class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 pl-10 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                                <option value="" disabled selected>اختر المجال الوظيفي</option>
                                @foreach ($departments as $d)
                                    <option value="{{ $d }}">{{ $d }}</option>
                                @endforeach
                            </select>
                            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                        </div>
                    </div>

                    <div>
                        <label for="c_branch" class="block text-xs font-bold text-[#141414] mb-2">فرع العمل المفضل <span class="text-brand">*</span></label>
                        <div class="relative">
                            <select id="c_branch" required
                                    style="-webkit-appearance:none; -moz-appearance:none; appearance:none;"
                                    class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 pl-10 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                                <option value="" disabled selected>اختر الفرع</option>
                                @foreach ($branches as $b)
                                    <option value="{{ $b->name }}">{{ $b->name }}</option>
                                @endforeach
                                <option value="مستعد للعمل في أي فرع">مستعد للعمل في أي فرع</option>
                            </select>
                            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                        </div>
                    </div>

                    <div>
                        <label for="c_letter" class="block text-xs font-bold text-[#141414] mb-2">نبذة قصيرة عن خبراتك (Cover Letter)</label>
                        <textarea id="c_letter" rows="4" placeholder="اكتب باختصار أبرز مهاراتك أو سنوات خبرتك"
                                  class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all resize-none"></textarea>
                    </div>

                    {{-- رفع السيرة الذاتية --}}
                    <div>
                        <label class="block text-xs font-bold text-[#141414] mb-2">إرفاق السيرة الذاتية (CV) <span class="text-brand">*</span></label>
                        <label for="c_cv"
                               class="flex flex-col items-center justify-center gap-2 w-full py-8 px-4 rounded-xl border-2 border-dashed border-gray-300
                                      bg-[#f7f7f8] hover:border-brand hover:bg-brand-light/40 cursor-pointer transition-all text-center">
                            <svg class="w-9 h-9 text-brand" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 16V4m0 0L8 8m4-4 4 4M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/>
                            </svg>
                            <span id="cvLabel" class="text-sm font-bold text-[#141414]">اضغط هنا لرفع الملف</span>
                            <span class="text-xs text-[#9a9a9a]">بصيغة PDF أو Word — بحد أقصى 5 ميغابايت</span>
                        </label>
                        <input type="file" id="c_cv" required accept=".pdf,.doc,.docx" class="hidden">
                    </div>

                    <div class="pt-2">
                        <button type="submit" id="cvSubmit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-brand hover:bg-brand-dark text-white px-10 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                            « إرســــال طلــب التوظيـــف »
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
(function () {
    const form = document.getElementById('cvForm');
    if (!form) return;

    const hrEmail  = @json($hr_email);
    const fileIn   = document.getElementById('c_cv');
    const fileLbl  = document.getElementById('cvLabel');
    const btn      = document.getElementById('cvSubmit');
    const okBox    = document.getElementById('cvSuccess');
    const errBox   = document.getElementById('cvError');
    const original = btn.innerHTML;

    fileIn.addEventListener('change', () => {
        fileLbl.textContent = fileIn.files.length ? fileIn.files[0].name : 'اضغط هنا لرفع الملف';
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const fd = new FormData();
        const name   = document.getElementById('c_name').value;
        const phone  = document.getElementById('c_phone').value;
        const email  = document.getElementById('c_email').value;
        const dept   = document.getElementById('c_dept').value;
        const branch = document.getElementById('c_branch').value;
        const letter = document.getElementById('c_letter').value;

        fd.append('full_name', name);
        fd.append('phone', phone);
        fd.append('email', email);
        fd.append('department', dept);
        fd.append('preferred_branch', branch);
        fd.append('cover_letter', letter);
        fd.append('cv', fileIn.files[0]);

        btn.disabled = true;
        btn.innerHTML = 'جاري الإرسال...';
        errBox.classList.add('hidden');

        fetch('{{ route('careers.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: fd,
        })
        .then(r => r.json().then(body => ({ status: r.status, body })))
        .then(({ status, body }) => {
            const res = body;
            btn.disabled = false;
            btn.innerHTML = original;

            if (status === 422) throw new Error(firstError(body));
            if (!body.ok) throw new Error('');

            okBox.innerHTML = 'شكراً لك! تم استلام طلب التوظيف وسيرتك الذاتية بنجاح. سيقوم قسم الموارد البشرية بمراجعة طلبك والتواصل معك عند توفر فرصة مناسبة.';
            okBox.classList.remove('hidden');
            okBox.scrollIntoView({ behavior: 'smooth', block: 'center' });

            // mailto لا يدعم إرفاق الملفات، لذا نضع رابط تحميل السيرة الذاتية في نص الرسالة
            const body =
                'الاسم الثلاثي: ' + name + '\n' +
                'رقم الهاتف: ' + phone + '\n' +
                'البريد الإلكتروني: ' + (email || 'غير متوفر') + '\n' +
                'المجال الوظيفي: ' + dept + '\n' +
                'الفرع المفضل: ' + branch + '\n\n' +
                'نبذة عن الخبرات:\n' + (letter || 'لا يوجد') + '\n\n' +
                'رابط تحميل السيرة الذاتية:\n' + (res.cv_url || 'غير متوفر');

            const subject = 'طلب توظيف جديد - ' + dept + ' - ' + branch;
            window.location.href = 'mailto:' + hrEmail
                + '?subject=' + encodeURIComponent(subject)
                + '&body=' + encodeURIComponent(body);

            form.reset();
            fileLbl.textContent = 'اضغط هنا لرفع الملف';
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = original;
            errBox.textContent = err.message
                || 'عذراً، تعذّر إرسال الطلب. تأكد من تعبئة كل الحقول وأن ملف السيرة الذاتية بصيغة PDF أو Word ولا يتجاوز 5 ميغابايت.';
            errBox.classList.remove('hidden');
        });
    });
})();
</script>
@endpush
