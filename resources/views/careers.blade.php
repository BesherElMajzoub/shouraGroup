@extends('layouts.app')

@section('title', __('careers.meta_title'))
@section('description', __('careers.meta_description'))

@section('content')

    @php
        $departments = [
            __('careers.departments.sales_marketing'),
            __('careers.departments.engineering_tenders'),
            __('careers.departments.technical_support'),
            __('careers.departments.admin_accounting'),
            __('careers.departments.warehouse_logistics'),
        ];
    @endphp

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => __('ui.nav.careers'),
        'eyebrow' => __('careers.header.eyebrow'),
        'title'   => __('careers.header.title'),
        'desc'    => $careers_intro,
    ])

    {{-- ===== WHY WORK WITH US ===== --}}
    <section class="py-20 lg:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('careers.why_work.eyebrow') }}</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">{{ __('careers.why_work.heading') }}</h2>
            </div>

            @php
                $perks = [
                    [
                        'title' => __('careers.perks.development.title'),
                        'desc' => __('careers.perks.development.desc'),
                        'icon' => 'M9.663 17h4.673M12 3v1m6.364.364-.707.707M21 12h-1M4 12H3m3.343-5.657-.707-.707m2.828 9.9a5 5 0 1 1 7.072 0l-.548.547A3.374 3.374 0 0 0 14 18.469V19a2 2 0 1 1-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547Z',
                    ],
                    [
                        'title' => __('careers.perks.stability.title'),
                        'desc' => __('careers.perks.stability.desc'),
                        'icon' => 'M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6',
                    ],
                    [
                        'title' => __('careers.perks.expansion.title'),
                        'desc' => __('careers.perks.expansion.desc'),
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
                <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('careers.form.eyebrow') }}</span>
                <h2 class="text-2xl sm:text-3xl font-black text-[#141414] mb-3">{{ __('careers.form.heading') }}</h2>
                <p class="text-[#4b4b4b] text-sm">{{ __('careers.form.paragraph') }}</p>
            </div>

            <div class="reveal bg-white p-7 sm:p-10 rounded-[2rem] shadow-lg ring-1 ring-black/5">
                <div id="cvSuccess" role="status" aria-live="polite" class="hidden mb-6 p-4 rounded-xl bg-green-50 text-green-800 text-sm font-bold text-start border border-green-200"></div>
                <div id="cvError" role="alert" class="hidden mb-6 p-4 rounded-xl bg-red-50 text-red-800 text-sm font-bold text-start border border-red-200"></div>

                <form id="cvForm" action="{{ route('careers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-start">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="c_name" class="block text-xs font-bold text-[#141414] mb-2">{{ __('careers.form.full_name_label') }} <span class="text-brand">*</span></label>
                            <input type="text" id="c_name" name="full_name" autocomplete="name" required
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                        </div>
                        <div>
                            <label for="c_phone" class="block text-xs font-bold text-[#141414] mb-2">{{ __('careers.form.phone_label') }} <span class="text-brand">*</span></label>
                            <input type="tel" id="c_phone" name="phone" autocomplete="tel" required placeholder="09xxxxxxxx" dir="ltr"
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] text-left focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="c_email" class="block text-xs font-bold text-[#141414] mb-2">{{ __('careers.form.email_label') }} <span class="text-brand">*</span></label>
                        <input type="email" id="c_email" name="email" autocomplete="email" required dir="ltr"
                               class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] text-left focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                    </div>

                    <div>
                        <label for="c_dept" class="block text-xs font-bold text-[#141414] mb-2">{{ __('careers.form.department_label') }} <span class="text-gray-400 font-normal">{{ __('careers.form.optional_label') }}</span></label>
                        <div class="relative">
                            <select id="c_dept" name="department"
                                    style="-webkit-appearance:none; -moz-appearance:none; appearance:none;"
                                    class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 pl-10 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                                <option value="" disabled selected>{{ __('careers.form.department_placeholder') }}</option>
                                @foreach ($departments as $d)
                                    <option value="{{ $d }}">{{ $d }}</option>
                                @endforeach
                            </select>
                            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                        </div>
                    </div>

                    <div>
                        <label for="c_branch" class="block text-xs font-bold text-[#141414] mb-2">{{ __('careers.form.branch_label') }} <span class="text-gray-400 font-normal">{{ __('careers.form.optional_label') }}</span></label>
                        <div class="relative">
                            <select id="c_branch" name="preferred_branch"
                                    style="-webkit-appearance:none; -moz-appearance:none; appearance:none;"
                                    class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 pl-10 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                                <option value="" disabled selected>{{ __('careers.form.branch_placeholder') }}</option>
                                @foreach ($branches as $b)
                                    <option value="{{ $b->name }}">{{ $b->name }}</option>
                                @endforeach
                                <option value="{{ __('careers.form.branch_any_option') }}">{{ __('careers.form.branch_any_option') }}</option>
                            </select>
                            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                        </div>
                    </div>

                    <div>
                        <label for="c_letter" class="block text-xs font-bold text-[#141414] mb-2">{{ __('careers.form.cover_letter_label') }}</label>
                        <textarea id="c_letter" name="cover_letter" rows="4" placeholder="{{ __('careers.form.cover_letter_placeholder') }}"
                                  class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all resize-none"></textarea>
                    </div>

                    {{-- رفع السيرة الذاتية --}}
                    <div>
                        <label class="block text-xs font-bold text-[#141414] mb-2">{{ __('careers.form.cv_label') }} <span class="text-brand">*</span></label>
                        <label for="c_cv"
                               class="flex flex-col items-center justify-center gap-2 w-full py-8 px-4 rounded-xl border-2 border-dashed border-gray-300
                                      bg-[#f7f7f8] hover:border-brand hover:bg-brand-light/40 cursor-pointer transition-all text-center">
                            <svg class="w-9 h-9 text-brand" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 16V4m0 0L8 8m4-4 4 4M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/>
                            </svg>
                            <span id="cvLabel" class="text-sm font-bold text-[#141414]">{{ __('careers.form.cv_upload_text') }}</span>
                            <span class="text-xs text-[#9a9a9a]">{{ __('careers.form.cv_hint') }}</span>
                        </label>
                        <input type="file" id="c_cv" name="cv" required accept=".pdf,.doc,.docx" class="hidden">
                    </div>

                    <div class="pt-2">
                        <button type="submit" id="cvSubmit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-brand hover:bg-brand-dark text-white px-10 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                            {{ __('careers.form.submit_btn') }}
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

    const fileIn   = document.getElementById('c_cv');
    const fileLbl  = document.getElementById('cvLabel');
    const btn      = document.getElementById('cvSubmit');
    const okBox    = document.getElementById('cvSuccess');
    const errBox   = document.getElementById('cvError');
    const original = btn.innerHTML;
    const cvUploadText  = @json(__('careers.form.cv_upload_text'));
    const sendingText   = @json(__('careers.js.sending'));
    const successHtml   = @json(__('careers.js.success'));
    const errorDefault  = @json(__('careers.js.error_default'));

    fileIn.addEventListener('change', () => {
        fileLbl.textContent = fileIn.files.length ? fileIn.files[0].name : cvUploadText;
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const fd = new FormData(form);

        btn.disabled = true;
        btn.innerHTML = sendingText;
        okBox.classList.add('hidden');
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
            btn.disabled = false;
            btn.innerHTML = original;

            if (status === 422) throw new Error(firstError(body));
            if (!body.ok) throw new Error('');

            okBox.innerHTML = successHtml;
            okBox.classList.remove('hidden');
            okBox.scrollIntoView({ behavior: 'smooth', block: 'center' });

            form.reset();
            fileLbl.textContent = cvUploadText;
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = original;
            errBox.textContent = err.message || errorDefault;
            errBox.classList.remove('hidden');
        });
    });

    function firstError(body) {
        const errors = body && body.errors ? Object.values(body.errors).flat() : [];
        return errors[0] || '';
    }
})();
</script>
@endpush
