@extends('layouts.app')

@section('title', __('contact.meta_title'))
@section('description', __('contact.meta_description'))

@section('content')

    @php
        // كل خدمة تحمل اسم قسمها المختص؛ نبني منها قائمة الأقسام دون تكرار
        $generalWhatsapp = preg_replace('/\D/', '', (string) $contact_whatsapp);

        $departments = collect([['name' => __('contact.general_inquiry'), 'email' => $contact_email, 'whatsapp' => $generalWhatsapp, 'sector' => null]])
            ->merge(
                $services->pluck('dept')->unique()->values()
                    ->map(fn ($dept) => ['name' => $dept, 'email' => $sales_email, 'whatsapp' => $generalWhatsapp, 'sector' => null])
            )
            // كل قطاع قسم مستقل ببريده ورقم واتسابه القادمين من لوحة التحكم
            ->merge(
                $sectors->map(fn ($s) => [
                    'name' => $s->name,
                    'email' => $s->contact_email,
                    'whatsapp' => $s->contact_whatsapp,
                    'sector' => $s->slug,
                ])
            )
            ->values();

        // القسم المحدد مسبقاً يأتي من رابط القطاع (?sector=) أو من ?department=
        // ويُحسب هنا على السيرفر حتى يظهر البريد والرقم الصحيحان قبل عمل الجافاسكربت
        $requestedSector = request('sector');
        $requestedDepartment = request('department');
        $selectedIndex = $departments->search(fn ($d) => $requestedSector
            ? $d['sector'] === $requestedSector
            : ($requestedDepartment && $d['name'] === $requestedDepartment));
        $selectedIndex = $selectedIndex === false ? 0 : $selectedIndex;
        $selectedDept = $departments[$selectedIndex];
    @endphp

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => __('ui.nav.contact'),
        'eyebrow' => __('contact.header.eyebrow'),
        'title'   => __('contact.header.title'),
        'desc'    => $contact_intro,
    ])

    {{-- ===== GENERAL CONTACT + FORM ===== --}}
    <section class="py-20 lg:py-24 bg-[#f7f7f8] relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-[0.03]"
             style="background-image:url('{{ asset('images/pattern.svg') }}'); background-size:120px;"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 grid lg:grid-cols-12 gap-12 lg:gap-16">

            {{-- معلومات التواصل المركزية --}}
            <div class="lg:col-span-5 space-y-6 text-right order-2 lg:order-1">
                <div>
                    <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('contact.info.eyebrow') }}</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-[#141414]">{{ __('contact.info.heading') }}</h2>
                </div>

                <div class="flex items-start gap-4 p-5 rounded-2xl bg-white ring-1 ring-black/5">
                    <span class="shrink-0 w-12 h-12 rounded-xl bg-brand text-white grid place-items-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                    </span>
                    <div>
                        <h3 class="text-base font-bold text-[#141414] mb-1">{{ __('contact.info.email_heading') }}</h3>
                        <a href="mailto:{{ $contact_email }}" class="text-sm text-[#4b4b4b] hover:text-brand transition-colors block" dir="ltr">{{ $contact_email }}</a>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5 rounded-2xl bg-white ring-1 ring-black/5">
                    <span class="shrink-0 w-12 h-12 rounded-xl bg-brand text-white grid place-items-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l1.5-4.5A1 1 0 0 1 5.45 4h13.1a1 1 0 0 1 .95.5L21 9M3 9h18M3 9v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V9"/></svg>
                    </span>
                    <div>
                        <h3 class="text-base font-bold text-[#141414] mb-1">{{ __('contact.info.wholesale_heading') }}</h3>
                        <a href="mailto:{{ $sales_email }}" class="text-sm text-[#4b4b4b] hover:text-brand transition-colors block" dir="ltr">{{ $sales_email }}</a>
                        <a href="{{ url('/wholesale') }}" class="inline-flex items-center gap-1 text-sm text-brand font-bold mt-1.5 hover:gap-2 transition-all">
                            {{ __('contact.info.wholesale_link') }}
                            <svg class="w-3.5 h-3.5 @if(app()->getLocale() === 'en') rotate-180 @endif" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5 rounded-2xl bg-white ring-1 ring-black/5">
                    <span class="shrink-0 w-12 h-12 rounded-xl bg-brand text-white grid place-items-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    </span>
                    <div>
                        <h3 class="text-base font-bold text-[#141414] mb-1">{{ __('contact.info.hours_heading') }}</h3>
                        <p class="text-sm text-[#4b4b4b]">{{ $working_hours }}</p>
                    </div>
                </div>
            </div>

            {{-- نموذج المراسلة --}}
            <div class="lg:col-span-7 order-1 lg:order-2 reveal bg-white p-7 sm:p-10 rounded-[2rem] shadow-lg ring-1 ring-black/5">
                <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('contact.form.eyebrow') }}</span>
                <h2 class="text-2xl font-black text-[#141414] mb-8 text-right">{{ __('contact.form.heading') }}</h2>

                <div id="formSuccess" class="hidden mb-6 p-4 rounded-xl bg-green-50 text-green-800 text-sm font-bold text-right border border-green-200"></div>
                <div id="formError" class="hidden mb-6 p-4 rounded-xl bg-red-50 text-red-800 text-sm font-bold text-right border border-red-200"></div>

                <form id="contactForm" class="space-y-6 text-right">
                    <div>
                        <label for="department" class="block text-xs font-bold text-[#141414] mb-2">{{ __('contact.form.department_label') }} <span class="text-brand">*</span></label>
                        <div class="relative">
                            <select id="department" required
                                    style="-webkit-appearance:none; -moz-appearance:none; appearance:none;"
                                    class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 pl-10 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                                @foreach ($departments as $i => $dept)
                                    <option value="{{ $dept['email'] }}" data-name="{{ $dept['name'] }}" data-sector="{{ $dept['sector'] }}" data-whatsapp="{{ $dept['whatsapp'] }}" {{ $i === $selectedIndex ? 'selected' : '' }}>{{ $dept['name'] }}</option>
                                @endforeach
                            </select>
                            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                        </div>
                        <div class="mt-2.5 flex flex-wrap items-center gap-x-2 gap-y-1 rounded-xl px-4 py-2.5 text-sm"
                             style="background:rgba(225,29,38,.05); border:1px solid rgba(225,29,38,.15);">
                            <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                            <span class="text-[#4b4b4b]">{{ __('contact.form.department_note') }}</span>
                            <a id="deptEmailLink" href="mailto:{{ $selectedDept['email'] }}" class="font-bold text-brand hover:underline" dir="ltr">{{ $selectedDept['email'] }}</a>
                            <span id="deptWhatsappWrap" class="{{ $selectedDept['whatsapp'] ? 'inline-flex' : 'hidden' }} items-center gap-2">
                                <span class="text-[#9a9a9a]">|</span>
                                <svg class="w-4 h-4 fill-current text-[#25D366] shrink-0" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.262 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.504-5.728-1.464L0 24zm6.59-4.846c1.6.95 3.197 1.451 4.863 1.452 5.48-.001 9.94-4.46 9.943-9.94.002-2.654-1.031-5.15-2.906-7.028C16.671 1.768 14.17.732 11.516.732 6.037.732 1.577 5.191 1.574 10.67c-.001 1.764.46 3.49 1.332 5.021l-1.011 3.69 3.753-.984zm12.333-6.52c-.3-.15-1.77-.874-2.043-.973-.274-.1-.473-.15-.673.15-.2.3-.77.973-.943 1.173-.173.2-.347.225-.647.075-.3-.15-1.267-.467-2.413-1.49-1.002-.894-1.396-1.564-1.595-1.9-.2-.33-.021-.508.13-.658.135-.135.3-.35.45-.525.15-.175.2-.299.3-.5.1-.2.05-.375-.025-.525-.075-.15-.673-1.62-.922-2.206-.24-.582-.486-.504-.673-.513-.173-.008-.372-.008-.572-.008-.2 0-.523.075-.797.375-.274.3-1.045 1.021-1.045 2.493 0 1.472 1.07 2.893 1.22 3.093.15.2 2.106 3.216 5.102 4.512.713.31 1.269.493 1.704.632.716.227 1.369.195 1.884.118.574-.085 1.77-.724 2.019-1.396.25-.672.25-1.246.175-1.396-.075-.15-.274-.225-.574-.375z"/></svg>
                                <a id="deptWhatsappLink" href="https://wa.me/{{ $selectedDept['whatsapp'] }}" target="_blank" rel="noopener" class="font-bold text-[#128C7E] hover:underline" dir="ltr">+{{ $selectedDept['whatsapp'] }}</a>
                            </span>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-xs font-bold text-[#141414] mb-2">{{ __('contact.form.name_label') }} <span class="text-brand">*</span></label>
                            <input type="text" id="name" required
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                        </div>
                        <div>
                            <label for="phone" class="block text-xs font-bold text-[#141414] mb-2">{{ __('contact.form.phone_label') }} <span class="text-brand">*</span></label>
                            <input type="tel" id="phone" required placeholder="09xxxxxxxx" dir="ltr"
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] text-left focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-xs font-bold text-[#141414] mb-2">{{ __('contact.form.email_label') }}</label>
                            <input type="email" id="email" dir="ltr"
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] text-left focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                        </div>
                        <div>
                            <label for="subject" class="block text-xs font-bold text-[#141414] mb-2">{{ __('contact.form.subject_label') }} <span class="text-brand">*</span></label>
                            <input type="text" id="subject" required
                                   class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold text-[#141414] mb-2">{{ __('contact.form.message_label') }} <span class="text-brand">*</span></label>
                        <textarea id="message" rows="5" required
                                  class="w-full bg-[#f7f7f8] rounded-xl px-4 py-3 text-sm text-[#141414] focus:outline-none focus:ring-2 focus:ring-brand focus:bg-white transition-all resize-none"></textarea>
                    </div>

                    <div class="pt-2 flex flex-col sm:flex-row gap-3">
                        <button type="submit" id="submitBtn"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-brand hover:bg-brand-dark text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-brand/20">
                            {{ __('contact.form.submit_btn') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                        </button>
                        <button type="submit" id="whatsappBtn"
                                class="{{ $selectedDept['whatsapp'] ? 'inline-flex' : 'hidden' }} w-full sm:w-auto items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-[#25d366]/20">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.262 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.504-5.728-1.464L0 24zm6.59-4.846c1.6.95 3.197 1.451 4.863 1.452 5.48-.001 9.94-4.46 9.943-9.94.002-2.654-1.031-5.15-2.906-7.028C16.671 1.768 14.17.732 11.516.732 6.037.732 1.577 5.191 1.574 10.67c-.001 1.764.46 3.49 1.332 5.021l-1.011 3.69 3.753-.984zm12.333-6.52c-.3-.15-1.77-.874-2.043-.973-.274-.1-.473-.15-.673.15-.2.3-.77.973-.943 1.173-.173.2-.347.225-.647.075-.3-.15-1.267-.467-2.413-1.49-1.002-.894-1.396-1.564-1.595-1.9-.2-.33-.021-.508.13-.658.135-.135.3-.35.45-.525.15-.175.2-.299.3-.5.1-.2.05-.375-.025-.525-.075-.15-.673-1.62-.922-2.206-.24-.582-.486-.504-.673-.513-.173-.008-.372-.008-.572-.008-.2 0-.523.075-.797.375-.274.3-1.045 1.021-1.045 2.493 0 1.472 1.07 2.893 1.22 3.093.15.2 2.106 3.216 5.102 4.512.713.31 1.269.493 1.704.632.716.227 1.369.195 1.884.118.574-.085 1.77-.724 2.019-1.396.25-.672.25-1.246.175-1.396-.075-.15-.274-.225-.574-.375z"/></svg>
                            {{ __('contact.form.whatsapp_btn') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- ===== BRANCHES ===== --}}
    <section class="py-20 lg:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-14 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('contact.branches.eyebrow') }}</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">{{ __('contact.branches.heading') }}</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($branches as $i => $b)
                    <article class="reveal group bg-white rounded-[1.75rem] p-7 shadow-sm ring-1 ring-black/5
                                    hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300"
                             style="transition-delay:{{ $i * 0.08 }}s">
                        <div class="w-14 h-14 rounded-2xl bg-brand text-white grid place-items-center mb-5 shadow-lg shadow-brand/25">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        </div>

                        <h3 class="text-xl font-black text-[#141414] mb-1">{{ $b->name }}</h3>
                        <p class="text-sm font-bold text-brand mb-5">{{ $b->description }}</p>

                        <div class="space-y-3 text-sm border-t border-gray-100 pt-5">
                            <div class="flex items-start gap-2.5 text-[#4b4b4b]">
                                <svg class="w-4 h-4 text-brand shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                                <span>{{ $b->address }}</span>
                            </div>

                            @if ($b->phone)
                                <a href="tel:{{ preg_replace('/\s/', '', $b->phone) }}" class="flex items-center gap-2.5 text-[#4b4b4b] hover:text-brand transition-colors">
                                    <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                                    <span>{{ __('contact.branches.phone_label') }}: <span dir="ltr">{{ $b->phone }}</span></span>
                                </a>
                            @endif

                            @if ($b->mobile)
                                <a href="tel:{{ preg_replace('/\s/', '', $b->mobile) }}" class="flex items-center gap-2.5 text-[#4b4b4b] hover:text-brand transition-colors">
                                    <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="2" width="12" height="20" rx="2"/><path d="M11 18h2"/></svg>
                                    <span>{{ __('contact.branches.mobile_label') }}: <span dir="ltr">{{ $b->mobile }}</span></span>
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== INTERACTIVE MAPS ===== --}}
    <section class="py-20 lg:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-12 reveal">
                <span class="inline-block text-brand font-bold text-sm mb-3">{{ __('contact.maps.eyebrow') }}</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#141414]">{{ __('contact.maps.heading') }}</h2>
            </div>

            {{-- أزرار اختيار الفرع --}}
            <div class="flex flex-wrap items-center justify-center gap-3 mb-8">
                @foreach ($branches as $i => $b)
                    <button type="button" data-map="{{ $b->id }}"
                            class="map-tab px-5 py-2.5 rounded-xl text-sm font-bold transition-all
                                   {{ $i === 0 ? 'bg-brand text-white shadow-lg shadow-brand/20' : 'bg-[#f7f7f8] text-[#4b4b4b] ring-1 ring-black/5 hover:bg-brand-light hover:text-brand' }}">
                        {{ $b->name }}
                    </button>
                @endforeach
            </div>

            <div class="reveal relative rounded-[2rem] overflow-hidden shadow-xl ring-1 ring-black/5">
                @foreach ($branches as $i => $b)
                    <iframe id="map-{{ $b->id }}"
                            class="map-frame w-full h-96 border-0 {{ $i === 0 ? '' : 'hidden' }}"
                            src="{{ $b->map_embed }}"
                            title="{{ __('contact.maps.title', ['name' => $b->name]) }}"
                            allowfullscreen loading="lazy"></iframe>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
// ===== تبديل خرائط الفروع =====
(function () {
    const tabs = [...document.querySelectorAll('.map-tab')];
    if (!tabs.length) return;
    const activeCls = ['bg-brand','text-white','shadow-lg','shadow-brand/20'];
    const idleCls   = ['bg-[#f7f7f8]','text-[#4b4b4b]','ring-1','ring-black/5','hover:bg-brand-light','hover:text-brand'];

    tabs.forEach(tab => tab.addEventListener('click', () => {
        tabs.forEach(t => { t.classList.remove(...activeCls); t.classList.add(...idleCls); });
        tab.classList.remove(...idleCls); tab.classList.add(...activeCls);

        document.querySelectorAll('.map-frame').forEach(f => f.classList.add('hidden'));
        document.getElementById('map-' + tab.dataset.map)?.classList.remove('hidden');
    }));
})();

// ===== نموذج المراسلة =====
(function () {
    const form = document.getElementById('contactForm');
    if (!form) return;

    const select   = document.getElementById('department');
    const deptLink = document.getElementById('deptEmailLink');
    const waWrap   = document.getElementById('deptWhatsappWrap');
    const waLink   = document.getElementById('deptWhatsappLink');
    const btn      = document.getElementById('submitBtn');
    const waBtn    = document.getElementById('whatsappBtn');
    const okBox    = document.getElementById('formSuccess');
    const errBox   = document.getElementById('formError');
    const original = btn.innerHTML;
    const waOriginal = waBtn.innerHTML;
    const sendingText = @json(__('contact.js.sending'));
    const serviceSubjectPrefix = @json(__('contact.js.service_subject_prefix'));
    const serviceMessagePlaceholder = @json(__('contact.js.service_message_placeholder'));
    const projectSubjectPrefix = @json(__('contact.js.project_subject_prefix'));
    const projectMessagePlaceholder = @json(__('contact.js.project_message_placeholder'));
    const successPrefix = @json(__('contact.js.success_prefix'));
    const successSuffix = @json(__('contact.js.success_suffix'));
    const errorDefault  = @json(__('contact.js.error_default'));
    const mailBodyLabels = @json(__('contact.js.mail_body'));

    // رقم واتساب القسم المختار، فارغ إن لم يُضبط له رقم من لوحة التحكم
    function deptWhatsapp() {
        const option = select.options[select.selectedIndex];
        return (option && option.dataset.whatsapp) || '';
    }

    function updateDeptEmail() {
        deptLink.textContent = select.value;
        deptLink.href = 'mailto:' + select.value;

        const number = deptWhatsapp();
        waWrap.classList.toggle('hidden', !number);
        waWrap.classList.toggle('inline-flex', !!number);
        waBtn.classList.toggle('hidden', !number);
        waBtn.classList.toggle('inline-flex', !!number);
        if (number) {
            waLink.textContent = '+' + number;
            waLink.href = 'https://wa.me/' + number;
        }
    }
    select.addEventListener('change', updateDeptEmail);
    updateDeptEmail();

    // الزر المضغوط يحدّد قناة الإرسال: البريد أم واتساب
    let channel = 'email';
    btn.addEventListener('click', () => { channel = 'email'; });
    waBtn.addEventListener('click', () => { channel = 'whatsapp'; });

    // تعبئة الموضوع مسبقاً من روابط الخدمات والقطاعات والمشاريع
    (function prefill() {
        const p = new URLSearchParams(window.location.search);
        const subjectInput = document.getElementById('subject');
        const messageArea  = document.getElementById('message');

        // ?sector=slug يأتي من صفحة القطاع ويختار قسم القطاع ببريده الخاص
        const sector = p.get('sector');
        const department = p.get('department');
        const match = sector
            ? [...select.options].find(o => o.dataset.sector === sector)
            : (department ? [...select.options].find(o => o.dataset.name === department) : null);
        if (match) { select.selectedIndex = match.index; updateDeptEmail(); }

        const service = p.get('service');
        const project = p.get('project');
        const subject = p.get('subject');

        if (service) {
            subjectInput.value = serviceSubjectPrefix + service;
            messageArea.placeholder = serviceMessagePlaceholder;
        } else if (project) {
            subjectInput.value = projectSubjectPrefix + project;
            messageArea.placeholder = projectMessagePlaceholder;
        } else if (subject) {
            subjectInput.value = subject;
        }
    })();

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const deptName  = select.options[select.selectedIndex].dataset.name;
        const deptEmail = select.value;
        const waNumber  = deptWhatsapp();
        const viaWa     = channel === 'whatsapp' && !!waNumber;
        const activeBtn = viaWa ? waBtn : btn;
        const activeOriginal = viaWa ? waOriginal : original;
        // تُفتح نافذة واتساب الآن ضمن نقرة المستخدم حتى لا يحجبها المتصفح
        const waWindow  = viaWa ? window.open('', '_blank') : null;
        channel = 'email'; // العودة للوضع الافتراضي حتى لا ترث الرسالة التالية القناة
        const name    = document.getElementById('name').value;
        const phone   = document.getElementById('phone').value;
        const email   = document.getElementById('email').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;

        activeBtn.disabled = true;
        activeBtn.innerHTML = sendingText;
        errBox.classList.add('hidden');

        fetch('{{ route('contact.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                name, phone, email, subject, message,
                department_name: deptName,
                department_email: deptEmail,
            }),
        })
        .then(r => r.json().then(body => ({ status: r.status, body })))
        .then(({ status, body }) => {
            activeBtn.disabled = false;
            activeBtn.innerHTML = activeOriginal;

            if (status === 422) throw new Error(firstError(body));
            if (!body.ok) throw new Error('');

            okBox.innerHTML = successPrefix + '<span class="font-black">' + deptName + '</span>' + successSuffix;
            okBox.classList.remove('hidden');
            okBox.scrollIntoView({ behavior: 'smooth', block: 'center' });

            const details =
                mailBodyLabels.name + name + '\n' +
                mailBodyLabels.phone + phone + '\n' +
                mailBodyLabels.email + (email || mailBodyLabels.not_available) + '\n' +
                mailBodyLabels.department + deptName + '\n\n' +
                mailBodyLabels.message_heading + '\n' + message;

            if (viaWa) {
                const waText = mailBodyLabels.subject + subject + '\n' + details;
                const waUrl  = 'https://wa.me/' + waNumber + '?text=' + encodeURIComponent(waText);
                if (waWindow) { waWindow.location.href = waUrl; } else { window.open(waUrl, '_blank'); }
            } else {
                window.location.href = 'mailto:' + deptEmail
                    + '?subject=' + encodeURIComponent(subject)
                    + '&body=' + encodeURIComponent(details);
            }

            form.reset();
            updateDeptEmail();
        })
        .catch(err => {
            activeBtn.disabled = false;
            activeBtn.innerHTML = activeOriginal;
            if (waWindow) waWindow.close();
            errBox.textContent = err.message || errorDefault;
            errBox.classList.remove('hidden');
        });
    });
})();
</script>
@endpush
