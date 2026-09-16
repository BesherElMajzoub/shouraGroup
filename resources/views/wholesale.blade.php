@extends('layouts.app')

@section('title', __('wholesale.meta_title'))
@section('description', __('wholesale.meta_description'))

@section('content')

    @php
        $govs = [
            __('wholesale.governorates.damascus'),
            __('wholesale.governorates.damascus_countryside'),
            __('wholesale.governorates.aleppo'),
            __('wholesale.governorates.homs'),
            __('wholesale.governorates.hama'),
            __('wholesale.governorates.lattakia'),
            __('wholesale.governorates.tartus'),
            __('wholesale.governorates.daraa'),
            __('wholesale.governorates.sweida'),
            __('wholesale.governorates.deir_ezzor'),
            __('wholesale.governorates.hasakah'),
            __('wholesale.governorates.raqqa'),
            __('wholesale.governorates.quneitra'),
            __('wholesale.governorates.idlib'),
        ];
        $whatsappDigits = preg_replace('/\D/', '', $whatsapp ?? '');
    @endphp

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => __('wholesale.header.current'),
        'eyebrow' => __('wholesale.header.eyebrow'),
        'title'   => __('wholesale.header.title'),
        'desc'    => $wholesale_intro,
    ])

    {{-- ===== WHY PARTNER WITH US ===== --}}
    <section class="py-20 lg:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('wholesale.why_partner.eyebrow') }}</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">{{ __('wholesale.why_partner.heading') }}</h2>
            </div>

            @php
                $perks = [
                    [
                        'title' => __('wholesale.perks.pricing.title'),
                        'desc' => __('wholesale.perks.pricing.desc'),
                        'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                    ],
                    [
                        'title' => __('wholesale.perks.coverage.title'),
                        'desc' => __('wholesale.perks.coverage.desc'),
                        'icon' => 'M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12ZM12 9h.01',
                    ],
                    [
                        'title' => __('wholesale.perks.priority_booking.title'),
                        'desc' => __('wholesale.perks.priority_booking.desc'),
                        'icon' => 'M5 5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16l-7-4-7 4V5ZM9 9h6',
                    ],
                    [
                        'title' => __('wholesale.perks.technical_support.title'),
                        'desc' => __('wholesale.perks.technical_support.desc'),
                        'icon' => 'M11.4 2.6a5 5 0 0 0 6 6L21 12l-2 2-3.4-3.4a5 5 0 0 1-6-6L7 1l4.4 1.6ZM3 17l6-6M3 17l3 3 6-6',
                    ],
                ];
            @endphp

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($perks as $i => $p)
                    <div class="reveal group bg-[#f7f7f8] rounded-2xl p-7 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                         style="transition-delay:{{ $i * 0.08 }}s">
                        <div class="w-14 h-14 rounded-xl bg-brand text-white grid place-items-center mb-5">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $p['icon'] }}"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-[#141414] mb-3 leading-snug">{{ $p['title'] }}</h3>
                        <p class="text-[#4b4b4b] text-sm leading-relaxed">{{ $p['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== B2B ORDER FORM ===== --}}
    <section id="order" class="scroll-mt-24 py-20 lg:py-24 bg-[#f7f7f8] relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.03]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 grid lg:grid-cols-12 gap-10 lg:gap-14 items-start">

            {{-- معلومات جانبية --}}
            <div class="lg:col-span-4 space-y-6 reveal">
                <div>
                    <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('wholesale.contact.eyebrow') }}</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-[#141414] mb-4">{{ __('wholesale.contact.heading') }}</h2>
                    <p class="text-[#4b4b4b] text-sm leading-relaxed">
                        {{ __('wholesale.contact.paragraph') }}
                    </p>
                </div>

                @if ($whatsappDigits)
                    <a href="https://wa.me/{{ $whatsappDigits }}?text={{ urlencode(__('wholesale.contact.whatsapp_message')) }}"
                       target="_blank" rel="noopener"
                       class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white py-3.5 rounded-xl font-bold text-sm transition-colors shadow-md shadow-[#25d366]/20">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.262 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.504-5.728-1.464L0 24zm6.59-4.846c1.6.95 3.197 1.451 4.863 1.452 5.48-.001 9.94-4.46 9.943-9.94.002-2.654-1.031-5.15-2.906-7.028C16.671 1.768 14.17.732 11.516.732 6.037.732 1.577 5.191 1.574 10.67c-.001 1.764.46 3.49 1.332 5.021l-1.011 3.69 3.753-.984zm12.333-6.52c-.3-.15-1.77-.874-2.043-.973-.274-.1-.473-.15-.673.15-.2.3-.77.973-.943 1.173-.173.2-.347.225-.647.075-.3-.15-1.267-.467-2.413-1.49-1.002-.894-1.396-1.564-1.595-1.9-.2-.33-.021-.508.13-.658.135-.135.3-.35.45-.525.15-.175.2-.299.3-.5.1-.2.05-.375-.025-.525-.075-.15-.673-1.62-.922-2.206-.24-.582-.486-.504-.673-.513-.173-.008-.372-.008-.572-.008-.2 0-.523.075-.797.375-.274.3-1.045 1.021-1.045 2.493 0 1.472 1.07 2.893 1.22 3.093.15.2 2.106 3.216 5.102 4.512.713.31 1.269.493 1.704.632.716.227 1.369.195 1.884.118.574-.085 1.77-.724 2.019-1.396.25-.672.25-1.246.175-1.396-.075-.15-.274-.225-.574-.375z"/></svg>
                        {{ __('wholesale.contact.whatsapp_btn') }}
                    </a>
                @endif

                <div class="bg-white rounded-2xl p-6 ring-1 ring-black/5 space-y-4">
                    <h3 class="font-bold text-[#141414] text-sm">{{ __('wholesale.contact.branches_heading') }}</h3>
                    @foreach ($branches as $b)
                        <div class="flex items-start gap-3 text-sm">
                            <svg class="w-4 h-4 text-brand shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                            <div>
                                <div class="font-bold text-[#141414]">{{ $b->address }}</div>
                                @if ($b->mobile)
                                    <a href="tel:{{ $b->mobile }}" class="text-[#4b4b4b] hover:text-brand transition-colors" dir="ltr">{{ $b->mobile }}</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- النموذج --}}
            <div class="lg:col-span-8 reveal bg-white p-7 sm:p-10 rounded-[2rem] shadow-lg ring-1 ring-black/5">
                <h3 class="text-xl font-black text-[#141414] mb-2">{{ __('wholesale.form.heading') }}</h3>
                <p class="text-[#9a9a9a] text-sm mb-8">{{ __('wholesale.form.required_prefix') }} <span class="text-brand">*</span> {{ __('wholesale.form.required_suffix') }}</p>

                <div id="wsSuccess" class="hidden mb-6 p-4 rounded-xl bg-green-50 text-green-800 text-sm font-bold text-start border border-green-200"></div>
                <div id="wsError" class="hidden mb-6 p-4 rounded-xl bg-red-50 text-red-800 text-sm font-bold text-start border border-red-200"></div>

                <form id="wsForm" class="space-y-6 text-start">
                    {{-- الاسم + الهاتف --}}
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="ws_name" class="block text-xs font-bold text-[#141414] mb-2">{{ __('wholesale.form.name_label') }} <span class="text-brand">*</span></label>
                            <input type="text" id="ws_name" required placeholder="{{ __('wholesale.form.name_placeholder') }}"
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                        </div>
                        <div>
                            <label for="ws_phone" class="block text-xs font-bold text-[#141414] mb-2">{{ __('wholesale.form.phone_label') }} <span class="text-brand">*</span></label>
                            <input type="tel" id="ws_phone" required placeholder="09xxxxxxxx" dir="ltr"
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] text-left focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                        </div>
                    </div>

                    {{-- المنتجات + المحافظة --}}
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="ws_product" class="block text-xs font-bold text-[#141414] mb-2">{{ __('wholesale.form.product_label') }} <span class="text-brand">*</span></label>
                            <div class="relative">
                                <select id="ws_product" required
                                        style="-webkit-appearance:none; -moz-appearance:none; appearance:none;"
                                        class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 pl-10 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                                    <option value="" disabled selected>{{ __('wholesale.form.product_placeholder') }}</option>
                                    @foreach ($sectors as $s)
                                        @php $brandNames = $s->brands->take(4)->pluck('name')->implode(', '); @endphp
                                        <option value="{{ $s->name }}{{ $brandNames ? ' (' . $brandNames . ')' : '' }}">
                                            {{ $s->name }}{{ $brandNames ? ' (' . $brandNames . ')' : '' }}
                                        </option>
                                    @endforeach
                                    <option value="{{ __('wholesale.form.product_other_option') }}">{{ __('wholesale.form.product_other_option') }}</option>
                                </select>
                                <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                            </div>
                        </div>
                        <div>
                            <label for="ws_gov" class="block text-xs font-bold text-[#141414] mb-2">{{ __('wholesale.form.governorate_label') }} <span class="text-brand">*</span></label>
                            <div class="relative">
                                <select id="ws_gov" required
                                        style="-webkit-appearance:none; -moz-appearance:none; appearance:none;"
                                        class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 pl-10 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                                    <option value="" disabled selected>{{ __('wholesale.form.governorate_placeholder') }}</option>
                                    @foreach ($govs as $g)
                                        <option value="{{ $g }}">{{ $g }}</option>
                                    @endforeach
                                </select>
                                <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- العنوان --}}
                    <div>
                        <label for="ws_address" class="block text-xs font-bold text-[#141414] mb-2">{{ __('wholesale.form.address_label') }} <span class="text-brand">*</span></label>
                        <input type="text" id="ws_address" required placeholder="{{ __('wholesale.form.address_placeholder') }}"
                               class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                    </div>

                    {{-- التفاصيل --}}
                    <div>
                        <label for="ws_message" class="block text-xs font-bold text-[#141414] mb-2">{{ __('wholesale.form.message_label') }}</label>
                        <textarea id="ws_message" rows="5" placeholder="{{ __('wholesale.form.message_placeholder') }}"
                                  class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all resize-none"></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" id="wsSubmit"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-brand hover:bg-brand-dark text-white px-10 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                            {{ __('wholesale.form.submit_btn') }}
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
    const form = document.getElementById('wsForm');
    if (!form) return;

    const salesEmail = @json($sales_email);
    const waDigits   = @json($whatsappDigits);
    const btn        = document.getElementById('wsSubmit');
    const okBox      = document.getElementById('wsSuccess');
    const errBox     = document.getElementById('wsError');
    const original   = btn.innerHTML;
    const sendingText  = @json(__('wholesale.js.sending'));
    const successHtml  = @json(__('wholesale.js.success'));
    const errorDefault = @json(__('wholesale.js.error_default'));
    const errorOrWa     = @json(__('wholesale.js.error_or_whatsapp'));
    const errorPeriod   = @json(__('wholesale.js.error_period'));
    const mailSubjectPrefix = @json(__('wholesale.js.mail_subject_prefix'));
    const mailBodyLabels = @json(__('wholesale.js.mail_body'));

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const data = {
            name: document.getElementById('ws_name').value,
            phone: document.getElementById('ws_phone').value,
            product_interest: document.getElementById('ws_product').value,
            governorate: document.getElementById('ws_gov').value,
            address: document.getElementById('ws_address').value,
            message: document.getElementById('ws_message').value,
        };

        btn.disabled = true;
        btn.innerHTML = sendingText;
        errBox.classList.add('hidden');

        fetch('{{ route('wholesale.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: JSON.stringify(data),
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

            // Pre-fill the mail client with the submitted form data
            const details =
                mailBodyLabels.name + data.name + '\n' +
                mailBodyLabels.phone + data.phone + '\n' +
                mailBodyLabels.product + data.product_interest + '\n' +
                mailBodyLabels.governorate + data.governorate + '\n' +
                mailBodyLabels.address + data.address + '\n\n' +
                mailBodyLabels.details_heading + '\n' + (data.message || mailBodyLabels.none);

            const subject = mailSubjectPrefix + data.product_interest + ' - ' + data.governorate;
            window.location.href = 'mailto:' + salesEmail
                + '?subject=' + encodeURIComponent(subject)
                + '&body=' + encodeURIComponent(details);

            form.reset();
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = original;
            errBox.textContent = err.message
                || (errorDefault + (waDigits ? errorOrWa : errorPeriod));
            errBox.classList.remove('hidden');
        });
    });
})();
</script>
@endpush
