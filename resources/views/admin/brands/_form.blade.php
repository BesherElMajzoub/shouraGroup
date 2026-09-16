{{--
    حقول نموذج العلامة التجارية المشتركة بين الإضافة والتعديل.
    المتغيرات: $sectors (كل القطاعات) · $brand (اختياري — في وضع التعديل)
--}}
@php
    $brand = $brand ?? null;
    $selectedSectors = old('sectors', $brand ? $brand->sectors->pluck('id')->all() : []);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="block text-xs font-bold text-gray-700 mb-2">اسم العلامة التجارية <span class="text-brand">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $brand->name ?? '') }}" required dir="ltr"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 text-left focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>

    <div>
        <label for="country" class="block text-xs font-bold text-gray-700 mb-2">بلد المنشأ</label>
        <input type="text" id="country" name="country" value="{{ old('country', $brand->country ?? '') }}" placeholder="إيطاليا"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6" dir="ltr">
    <div class="text-left">
        <label for="name_en" class="block text-xs font-bold text-gray-700 mb-2">Brand name — English <span class="text-brand">*</span></label>
        <input type="text" id="name_en" name="name_en" value="{{ old('name_en', $brand->name_en ?? '') }}" required
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand">
    </div>
    <div class="text-left">
        <label for="country_en" class="block text-xs font-bold text-gray-700 mb-2">Country — English</label>
        <input type="text" id="country_en" name="country_en" value="{{ old('country_en', $brand->country_en ?? '') }}"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="slug" class="block text-xs font-bold text-gray-700 mb-2">المعرّف في الرابط (بالإنجليزية)</label>
        <input type="text" id="slug" name="slug" value="{{ old('slug', $brand->slug ?? '') }}" dir="ltr" placeholder="foras"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 text-left focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>

    <div>
        <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب <span class="text-brand">*</span></label>
        <input type="number" id="order" name="order" value="{{ old('order', $brand->order ?? 0) }}" required
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>
</div>

<div dir="ltr" class="text-left">
    <label for="description_en" class="block text-xs font-bold text-gray-700 mb-2">Product range — English</label>
    <textarea id="description_en" name="description_en" rows="3"
              class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand">{{ old('description_en', $brand->description_en ?? '') }}</textarea>
</div>

<div>
    <label for="description" class="block text-xs font-bold text-gray-700 mb-2">مجال المنتجات</label>
    <textarea id="description" name="description" rows="3"
              class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">{{ old('description', $brand->description ?? '') }}</textarea>
</div>

<div>
    <span class="block text-xs font-bold text-gray-700 mb-3">القطاعات المرتبطة</span>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
        @foreach ($sectors as $s)
            <label class="flex items-center gap-2 p-3 rounded-xl bg-gray-50 border border-gray-200 cursor-pointer hover:bg-gray-100 transition-colors">
                <input type="checkbox" name="sectors[]" value="{{ $s->id }}"
                       {{ in_array($s->id, $selectedSectors) ? 'checked' : '' }}
                       class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
                <span class="text-xs text-gray-700 font-bold">{{ $s->name }}</span>
            </label>
        @endforeach
    </div>
    <p class="text-[11px] text-gray-400 mt-2">يمكن ربط العلامة بأكثر من قطاع — مثلاً ALUP تظهر في ضواغط الهواء وفي الغازات الطبية.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
    <div class="space-y-3">
        <label for="logo" class="block text-xs font-bold text-gray-700">شعار العلامة التجارية</label>
        <input type="file" id="logo" name="logo" accept="image/*"
               class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
        <p class="text-[11px] text-gray-400">بدون شعار، تُعرض العلامة كبطاقة نصية باسمها في الموقع.</p>
        @if ($brand && $brand->logo_url)
            <div>
                <span class="block text-[10px] font-bold text-gray-400 mb-1">الشعار الحالي:</span>
                <div class="h-16 w-32 bg-gray-50 border border-gray-200 rounded-xl p-1 flex items-center justify-center">
                    <img src="{{ $brand->logo_url }}" alt="" class="max-h-full max-w-full object-contain">
                </div>
            </div>
        @endif
    </div>

    <div class="space-y-3 pt-6">
        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_agency" name="is_agency" value="1" {{ old('is_agency', $brand->is_agency ?? false) ? 'checked' : '' }}
                   class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
            <label for="is_agency" class="text-xs text-gray-700 font-bold">وكالة رسمية معتمدة (تظهر في قسم «وكالاتنا الرسمية»)</label>
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" id="show_on_home" name="show_on_home" value="1" {{ old('show_on_home', $brand->show_on_home ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
            <label for="show_on_home" class="text-xs text-gray-700 font-bold">تظهر في قسم «شركاؤنا» بالصفحة الرئيسية</label>
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $brand->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
            <label for="is_active" class="text-xs text-gray-700 font-bold">نشطة وتظهر في الموقع</label>
        </div>
    </div>
</div>
