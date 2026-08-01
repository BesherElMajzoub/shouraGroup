{{--
    حقول نموذج القطاع المشتركة بين الإضافة والتعديل.
    المتغير: $sector (اختياري — موجود في وضع التعديل فقط)
--}}
@php $sector = $sector ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="block text-xs font-bold text-gray-700 mb-2">اسم القطاع <span class="text-brand">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $sector->name ?? '') }}" required
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>

    <div>
        <label for="slug" class="block text-xs font-bold text-gray-700 mb-2">المعرّف في الرابط (بالإنجليزية)</label>
        <input type="text" id="slug" name="slug" value="{{ old('slug', $sector->slug ?? '') }}" dir="ltr" placeholder="water-pumps"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 text-left focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
        <p class="text-[11px] text-gray-400 mt-1.5">يظهر في رابط الصفحة: /sectors/<span dir="ltr">water-pumps</span></p>
    </div>
</div>

<div>
    <label for="tagline" class="block text-xs font-bold text-gray-700 mb-2">العنوان الفرعي</label>
    <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $sector->tagline ?? '') }}"
           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
</div>

<div>
    <label for="intro" class="block text-xs font-bold text-gray-700 mb-2">نبذة عن القطاع</label>
    <textarea id="intro" name="intro" rows="4"
              class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">{{ old('intro', $sector->intro ?? '') }}</textarea>
</div>

<div>
    <label for="specialties" class="block text-xs font-bold text-gray-700 mb-2">التخصصات والمعدات</label>
    <textarea id="specialties" name="specialties" rows="5" placeholder="بند في كل سطر"
              class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">{{ old('specialties', implode("\n", $sector->specialties ?? [])) }}</textarea>
    <p class="text-[11px] text-gray-400 mt-1.5">اكتب كل بند في سطر منفصل.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="icon" class="block text-xs font-bold text-gray-700 mb-2">مسار الأيقونة (SVG path)</label>
        <input type="text" id="icon" name="icon" value="{{ old('icon', $sector->icon ?? '') }}" dir="ltr"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-xs text-gray-900 border border-gray-200 font-mono text-left focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
        <p class="text-[11px] text-gray-400 mt-1.5">قيمة السمة <span dir="ltr">d</span> لأيقونة SVG بمقاس 24×24.</p>
    </div>

    <div>
        <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب <span class="text-brand">*</span></label>
        <input type="number" id="order" name="order" value="{{ old('order', $sector->order ?? 0) }}" required
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
    <div class="space-y-3">
        <label for="image" class="block text-xs font-bold text-gray-700">صورة القطاع</label>
        <input type="file" id="image" name="image" accept="image/*"
               class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
        @if ($sector && $sector->image)
            <div>
                <span class="block text-[10px] font-bold text-gray-400 mb-1">الصورة الحالية:</span>
                <div class="h-20 w-36 bg-gray-50 border border-gray-200 rounded-xl p-1 flex items-center justify-center overflow-hidden">
                    <img src="{{ $sector->image_url }}" alt="" class="max-h-full max-w-full object-contain">
                </div>
            </div>
        @endif
    </div>

    <div class="space-y-3 pt-6">
        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $sector->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
            <label for="is_active" class="text-xs text-gray-700 font-bold">نشط ويظهر في الموقع</label>
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_coming_soon" name="is_coming_soon" value="1" {{ old('is_coming_soon', $sector->is_coming_soon ?? false) ? 'checked' : '' }}
                   class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
            <label for="is_coming_soon" class="text-xs text-gray-700 font-bold">قيد التأسيس (يُعرض بشارة «قريباً» بدون صفحة تفاصيل)</label>
        </div>
    </div>
</div>
