{{--
    حقول نموذج الفرع المشتركة بين الإضافة والتعديل.
    المتغير: $branch (اختياري — في وضع التعديل فقط)
--}}
@php $branch = $branch ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="block text-xs font-bold text-gray-700 mb-2">اسم الفرع <span class="text-brand">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $branch->name ?? '') }}" required placeholder="فرع دمشق – المرجة"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>

    <div>
        <label for="city" class="block text-xs font-bold text-gray-700 mb-2">المدينة <span class="text-brand">*</span></label>
        <input type="text" id="city" name="city" value="{{ old('city', $branch->city ?? '') }}" required placeholder="دمشق"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6" dir="ltr">
    <div class="text-left">
        <label for="name_en" class="block text-xs font-bold text-gray-700 mb-2">Branch name — English <span class="text-brand">*</span></label>
        <input type="text" id="name_en" name="name_en" value="{{ old('name_en', $branch->name_en ?? '') }}" required
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand">
    </div>
    <div class="text-left">
        <label for="city_en" class="block text-xs font-bold text-gray-700 mb-2">City — English <span class="text-brand">*</span></label>
        <input type="text" id="city_en" name="city_en" value="{{ old('city_en', $branch->city_en ?? '') }}" required
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="address" class="block text-xs font-bold text-gray-700 mb-2">العنوان <span class="text-brand">*</span></label>
        <input type="text" id="address" name="address" value="{{ old('address', $branch->address ?? '') }}" required placeholder="دمشق - المرجة"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>

    <div>
        <label for="description" class="block text-xs font-bold text-gray-700 mb-2">وصف مختصر</label>
        <input type="text" id="description" name="description" value="{{ old('description', $branch->description ?? '') }}" placeholder="صالة عرض ومبيعات مفرق وجملة"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6" dir="ltr">
    <div class="text-left">
        <label for="address_en" class="block text-xs font-bold text-gray-700 mb-2">Address — English <span class="text-brand">*</span></label>
        <input type="text" id="address_en" name="address_en" value="{{ old('address_en', $branch->address_en ?? '') }}" required
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand">
    </div>
    <div class="text-left">
        <label for="description_en" class="block text-xs font-bold text-gray-700 mb-2">Short description — English</label>
        <input type="text" id="description_en" name="description_en" value="{{ old('description_en', $branch->description_en ?? '') }}"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="phone" class="block text-xs font-bold text-gray-700 mb-2">الهاتف الأرضي</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $branch->phone ?? '') }}" dir="ltr" placeholder="011 2233743"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 text-left focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>

    <div>
        <label for="mobile" class="block text-xs font-bold text-gray-700 mb-2">الجوال</label>
        <input type="text" id="mobile" name="mobile" value="{{ old('mobile', $branch->mobile ?? '') }}" dir="ltr" placeholder="0932101176"
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 text-left focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>
</div>

<div class="p-5 rounded-2xl bg-gray-50 border border-gray-200 space-y-4">
    <div>
        <span class="block text-xs font-bold text-gray-700">موضع الدبوس على خريطة سوريا</span>
        <p class="text-[11px] text-gray-400 mt-1">نسبة مئوية من أعلى الخريطة ومن يسارها. مثال دمشق: 78% من الأعلى و9% من اليسار — حلب: 28% و28%.</p>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="map_top" class="block text-[11px] font-bold text-gray-600 mb-1.5">من الأعلى (%)</label>
            <input type="number" step="0.01" min="0" max="100" id="map_top" name="map_top" value="{{ old('map_top', $branch->map_top ?? 50) }}" required
                   class="w-full bg-white rounded-xl px-4 py-2.5 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand transition-all">
        </div>
        <div>
            <label for="map_left" class="block text-[11px] font-bold text-gray-600 mb-1.5">من اليسار (%)</label>
            <input type="number" step="0.01" min="0" max="100" id="map_left" name="map_left" value="{{ old('map_left', $branch->map_left ?? 50) }}" required
                   class="w-full bg-white rounded-xl px-4 py-2.5 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand transition-all">
        </div>
    </div>
</div>

<div>
    <label for="map_embed" class="block text-xs font-bold text-gray-700 mb-2">رابط موقع الفرع على خرائط جوجل</label>
    <input type="url" id="map_embed" name="map_embed" value="{{ old('map_embed', $branch->map_embed ?? '') }}" dir="ltr"
           placeholder="https://maps.google.com/maps?q=33.5142,36.2973&hl=ar&z=16&output=embed"
           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-xs text-gray-900 border border-gray-200 font-mono text-left focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    <p class="text-[11px] text-gray-400 mt-1.5">الصق أي رابط من خرائط جوجل (Google Maps): رابط المشاركة، أو رابط <span dir="ltr">Embed</span>، أو رابط بالإحداثيات — يظهر في خريطة صفحة «اتصل بنا». إن تُرك فارغاً نستخدم عنوان الفرع تلقائياً.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
    <div>
        <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب <span class="text-brand">*</span></label>
        <input type="number" id="order" name="order" value="{{ old('order', $branch->order ?? 0) }}" required
               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
    </div>

    <div class="flex items-center gap-2 pt-6">
        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $branch->is_active ?? true) ? 'checked' : '' }}
               class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
        <label for="is_active" class="text-xs text-gray-700 font-bold">نشط ويظهر في الموقع</label>
    </div>
</div>
