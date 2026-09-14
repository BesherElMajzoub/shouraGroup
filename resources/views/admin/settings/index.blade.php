@extends('layouts.admin')

@section('title', 'النصوص والفقرات')
@section('page_title', 'إدارة نصوص وصفحات الموقع')

@section('admin_content')

    @php
        $field = 'w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all';
        $label = 'block text-xs font-bold text-gray-700 mb-2';
        $card = 'bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right';
        $homeAboutImages = [
            ['home_about_main_image', 'الصورة الكبيرة لقسم «من نحن»', 'images/about_skyscrapers.png'],
            ['home_about_secondary_image', 'الصورة الصغيرة لقسم «من نحن»', 'images/industrial_bg.png'],
        ];
    @endphp

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- ===== الصفحة الرئيسية ===== --}}
            <div class="{{ $card }}">
                <h3 class="text-base font-black text-gray-900 pb-4 border-b border-gray-100">نصوص الصفحة الرئيسية</h3>

                <div>
                    <label for="about_subtitle" class="{{ $label }}">العنوان الفرعي لقسم «من نحن»</label>
                    <input type="text" id="about_subtitle" name="about_subtitle" required
                           value="{{ old('about_subtitle', $settings['about_subtitle'] ?? '') }}" class="{{ $field }}">
                </div>

                <div>
                    <label for="about_body" class="{{ $label }}">فقرات «من نحن»</label>
                    <textarea id="about_body" name="about_body" rows="7" required class="{{ $field }} resize-none">{{ old('about_body', $settings['about_body'] ?? '') }}</textarea>
                    <p class="text-[11px] text-gray-400 mt-1.5">افصل بين كل فقرة والأخرى بسطر فارغ.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($homeAboutImages as [$key, $imageLabel, $defaultImage])
                        @php($imagePath = $settings[$key] ?? $defaultImage)
                        <div>
                            <label for="{{ $key }}" class="{{ $label }}">{{ $imageLabel }}</label>
                            <div class="h-32 w-full rounded-xl overflow-hidden shadow-sm ring-1 ring-black/5 bg-gray-50 mb-3">
                                <img src="{{ str_starts_with($imagePath, 'images/') ? asset($imagePath) : asset('storage/' . $imagePath) }}"
                                     alt="" class="w-full h-full object-cover">
                            </div>
                            <input type="file" id="{{ $key }}" name="{{ $key }}" accept="image/*"
                                   class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                        </div>
                    @endforeach
                </div>
                <p class="text-[10px] text-gray-400 -mt-3">الصيغ المدعومة: PNG, JPG, JPEG, GIF — بحد أقصى 2 ميغابايت لكل صورة.</p>

                @php($homeAboutLogo = $settings['home_about_logo'] ?? 'images/shora-logo.svg')
                <div>
                    <label for="home_about_logo" class="{{ $label }}">شعار البطاقة الحمراء في قسم «من نحن»</label>
                    <div class="h-32 w-full rounded-xl overflow-hidden shadow-sm ring-1 ring-black/5 bg-brand grid place-items-center mb-3">
                        <img src="{{ str_starts_with($homeAboutLogo, 'images/') ? asset($homeAboutLogo) : asset('storage/' . $homeAboutLogo) }}"
                             alt="" class="h-16 w-auto max-w-[80%] brightness-0 invert">
                    </div>
                    <input type="file" id="home_about_logo" name="home_about_logo" accept=".png,.jpg,.jpeg,.webp,.svg,image/*"
                           class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                    <p class="text-[10px] text-gray-400 mt-1.5">يفضّل شعار بخلفية شفافة. الصيغ المدعومة: PNG, JPG, JPEG, WEBP, SVG — بحد أقصى 2 ميغابايت.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="vision_text" class="{{ $label }}">نص الرؤية</label>
                        <textarea id="vision_text" name="vision_text" rows="4" required class="{{ $field }} resize-none">{{ old('vision_text', $settings['vision_text'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="mission_text" class="{{ $label }}">نص الرسالة</label>
                        <textarea id="mission_text" name="mission_text" rows="4" required class="{{ $field }} resize-none">{{ old('mission_text', $settings['mission_text'] ?? '') }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="partners_intro" class="{{ $label }}">مقدمة قسم «شركاؤنا»</label>
                        <textarea id="partners_intro" name="partners_intro" rows="3" required class="{{ $field }} resize-none">{{ old('partners_intro', $settings['partners_intro'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="clients_intro" class="{{ $label }}">مقدمة قسم «عملاؤنا»</label>
                        <textarea id="clients_intro" name="clients_intro" rows="3" required class="{{ $field }} resize-none">{{ old('clients_intro', $settings['clients_intro'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ===== صفحة من نحن ===== --}}
            <div class="{{ $card }}">
                <h3 class="text-base font-black text-gray-900 pb-4 border-b border-gray-100">صفحة «من نحن»</h3>

                <div>
                    <label for="story_overview_body" class="{{ $label }}">فقرة «كيف بدأت الحكاية»</label>
                    <textarea id="story_overview_body" name="story_overview_body" rows="6" required class="{{ $field }} resize-none">{{ old('story_overview_body', $settings['story_overview_body'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="{{ $label }}">صورة صفحة «من نحن»</label>
                    <div class="flex items-center gap-4 flex-wrap">
                        @isset($settings['story_overview_image'])
                            <div class="h-24 w-40 rounded-xl overflow-hidden shadow-sm ring-1 ring-black/5 bg-gray-50">
                                <img src="{{ str_starts_with($settings['story_overview_image'], 'images/') ? asset($settings['story_overview_image']) : asset('storage/' . $settings['story_overview_image']) }}" alt="" class="w-full h-full object-cover">
                            </div>
                        @endisset
                        <div class="flex-1 min-w-[200px]">
                            <input type="file" id="story_overview_image" name="story_overview_image" accept="image/*"
                                   class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                            <span class="text-[10px] text-gray-400 block mt-1">الصيغ المدعومة: PNG, JPG, JPEG, GIF — بحد أقصى 2 ميغابايت.</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== نصوص الصفحات الداخلية ===== --}}
            <div class="{{ $card }}">
                <h3 class="text-base font-black text-gray-900 pb-4 border-b border-gray-100">النصوص الترحيبية للصفحات الداخلية</h3>

                @foreach ([
                    ['sectors_intro', 'قطاعاتنا'],
                    ['services_intro', 'خدماتنا وحلولنا'],
                    ['brands_intro', 'العلامات التجارية'],
                    ['projects_intro', 'مشاريعنا'],
                    ['wholesale_intro', 'مبيعات الجملة'],
                    ['careers_intro', 'انضم إلى فريقنا'],
                    ['contact_intro', 'اتصل بنا'],
                ] as [$key, $pageName])
                    <div>
                        <label for="{{ $key }}" class="{{ $label }}">صفحة «{{ $pageName }}»</label>
                        <textarea id="{{ $key }}" name="{{ $key }}" rows="3" required class="{{ $field }} resize-none">{{ old($key, $settings[$key] ?? '') }}</textarea>
                    </div>
                @endforeach
            </div>

            {{-- ===== بيانات التواصل ===== --}}
            <div class="{{ $card }}">
                <h3 class="text-base font-black text-gray-900 pb-4 border-b border-gray-100">بيانات التواصل</h3>
                <p class="text-xs text-gray-400 -mt-2">تظهر هذه البيانات في الشريط العلوي والفوتر وصفحة اتصل بنا، وتُستخدم لتوجيه النماذج إلى البريد الصحيح.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="contact_email" class="{{ $label }}">البريد الرسمي (الاستفسارات العامة)</label>
                        <input type="email" id="contact_email" name="contact_email" required dir="ltr"
                               value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="{{ $field }} text-left">
                    </div>
                    <div>
                        <label for="sales_email" class="{{ $label }}">بريد المبيعات والمشاريع</label>
                        <input type="email" id="sales_email" name="sales_email" required dir="ltr"
                               value="{{ old('sales_email', $settings['sales_email'] ?? '') }}" class="{{ $field }} text-left">
                        <p class="text-[11px] text-gray-400 mt-1.5">تُوجَّه إليه طلبات مبيعات الجملة.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="hr_email" class="{{ $label }}">بريد الموارد البشرية</label>
                        <input type="email" id="hr_email" name="hr_email" required dir="ltr"
                               value="{{ old('hr_email', $settings['hr_email'] ?? '') }}" class="{{ $field }} text-left">
                        <p class="text-[11px] text-gray-400 mt-1.5">تُوجَّه إليه طلبات التوظيف.</p>
                    </div>
                    <div>
                        <label for="phone_main" class="{{ $label }}">الهاتف الرئيسي</label>
                        <input type="text" id="phone_main" name="phone_main" required dir="ltr" placeholder="011 2233743"
                               value="{{ old('phone_main', $settings['phone_main'] ?? '') }}" class="{{ $field }} text-left">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="wholesale_whatsapp" class="{{ $label }}">رقم واتساب مبيعات الجملة</label>
                        <input type="text" id="wholesale_whatsapp" name="wholesale_whatsapp" dir="ltr" placeholder="963932101176"
                               value="{{ old('wholesale_whatsapp', $settings['wholesale_whatsapp'] ?? '') }}" class="{{ $field }} text-left">
                        <p class="text-[11px] text-gray-400 mt-1.5">بالصيغة الدولية بدون علامة + أو أصفار بادئة. اتركه فارغاً لإخفاء زر الواتساب.</p>
                    </div>
                    <div>
                        <label for="working_hours" class="{{ $label }}">أوقات الدوام الرسمي</label>
                        <input type="text" id="working_hours" name="working_hours" required
                               value="{{ old('working_hours', $settings['working_hours'] ?? '') }}" class="{{ $field }}">
                    </div>
                </div>
            </div>

            <div class="flex justify-start">
                <button type="submit" class="bg-brand hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
                    حفظ كل التغييرات
                </button>
            </div>
        </form>
    </div>

@endsection
