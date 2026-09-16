@php
    $project = $project ?? null;
    $inputClass = 'w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all';
    $textAreas = [
        ['summary', 'نبذة مختصرة', 'Short summary', 3],
        ['description', 'الوصف التفصيلي', 'Detailed overview', 5],
        ['challenge', 'التحديات', 'Challenges', 4],
        ['solution', 'الحلول المقدّمة', 'Solutions provided', 4],
        ['scope', 'نطاق الأعمال', 'Scope of work', 4],
        ['equipment', 'المعدات أو العلامات المستخدمة', 'Equipment or brands used', 4],
        ['results', 'النتائج', 'Results', 4],
    ];
@endphp

@if ($errors->any())
    <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <p class="font-bold mb-2">يرجى مراجعة الحقول التالية:</p>
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="space-y-5">
    <div>
        <h3 class="font-black text-gray-900">المعلومات الأساسية</h3>
        <p class="text-xs text-gray-500 mt-1">يُعرض المحتوى العربي أو الإنجليزي تلقائيًا حسب لغة الموقع.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="title_ar" class="block text-xs font-bold text-gray-700 mb-2">عنوان المشروع (عربي) *</label>
            <input id="title_ar" name="title_ar" value="{{ old('title_ar', $project?->title_ar) }}" required class="{{ $inputClass }}">
        </div>
        <div>
            <label for="title_en" class="block text-xs font-bold text-gray-700 mb-2">عنوان المشروع (English)</label>
            <input id="title_en" name="title_en" value="{{ old('title_en', $project?->title_en) }}" dir="ltr" class="{{ $inputClass }} text-left">
        </div>
        <div>
            <label for="category_id" class="block text-xs font-bold text-gray-700 mb-2">تصنيف المشروع *</label>
            <select id="category_id" name="category_id" required class="{{ $inputClass }}">
                <option value="">-- اختر التصنيف --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $project?->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="slug" class="block text-xs font-bold text-gray-700 mb-2">الرابط الفريد (اختياري)</label>
            <input id="slug" name="slug" value="{{ old('slug', $project?->slug) }}" placeholder="project-name" dir="ltr" class="{{ $inputClass }} text-left">
        </div>
    </div>
</section>

<section class="space-y-5 pt-6 border-t border-gray-100">
    <h3 class="font-black text-gray-900">بيانات المشروع</h3>

    @foreach ([['client', 'الجهة المستفيدة', 'Client'], ['location', 'الموقع', 'Location'], ['status', 'حالة المشروع', 'Project status']] as [$field, $labelAr, $labelEn])
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="{{ $field }}_ar" class="block text-xs font-bold text-gray-700 mb-2">{{ $labelAr }} (عربي)</label>
                <input id="{{ $field }}_ar" name="{{ $field }}_ar" value="{{ old($field.'_ar', $project?->{$field.'_ar'}) }}" class="{{ $inputClass }}">
            </div>
            <div>
                <label for="{{ $field }}_en" class="block text-xs font-bold text-gray-700 mb-2">{{ $labelEn }} (English)</label>
                <input id="{{ $field }}_en" name="{{ $field }}_en" value="{{ old($field.'_en', $project?->{$field.'_en'}) }}" dir="ltr" class="{{ $inputClass }} text-left">
            </div>
        </div>
    @endforeach

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div>
            <label for="year" class="block text-xs font-bold text-gray-700 mb-2">السنة</label>
            <input id="year" name="year" value="{{ old('year', $project?->year) }}" placeholder="2026" class="{{ $inputClass }}">
        </div>
        <div>
            <label for="duration_ar" class="block text-xs font-bold text-gray-700 mb-2">مدة التنفيذ (عربي)</label>
            <input id="duration_ar" name="duration_ar" value="{{ old('duration_ar', $project?->duration_ar) }}" class="{{ $inputClass }}">
        </div>
        <div>
            <label for="duration_en" class="block text-xs font-bold text-gray-700 mb-2">Duration (English)</label>
            <input id="duration_en" name="duration_en" value="{{ old('duration_en', $project?->duration_en) }}" dir="ltr" class="{{ $inputClass }} text-left">
        </div>
    </div>
</section>

<section class="space-y-6 pt-6 border-t border-gray-100">
    <div>
        <h3 class="font-black text-gray-900">التفاصيل الدقيقة</h3>
        <p class="text-xs text-gray-500 mt-1">اترك أي قسم فارغًا إذا لم تكن بحاجة إلى عرضه في صفحة المشروع.</p>
    </div>

    @foreach ($textAreas as [$field, $labelAr, $labelEn, $rows])
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <div>
                <label for="{{ $field }}_ar" class="block text-xs font-bold text-gray-700 mb-2">{{ $labelAr }} (عربي)</label>
                <textarea id="{{ $field }}_ar" name="{{ $field }}_ar" rows="{{ $rows }}" class="{{ $inputClass }} resize-y">{{ old($field.'_ar', $project?->{$field.'_ar'}) }}</textarea>
            </div>
            <div>
                <label for="{{ $field }}_en" class="block text-xs font-bold text-gray-700 mb-2">{{ $labelEn }} (English)</label>
                <textarea id="{{ $field }}_en" name="{{ $field }}_en" rows="{{ $rows }}" dir="ltr" class="{{ $inputClass }} resize-y text-left">{{ old($field.'_en', $project?->{$field.'_en'}) }}</textarea>
            </div>
        </div>
    @endforeach
</section>

<section class="space-y-5 pt-6 border-t border-gray-100">
    <div>
        <h3 class="font-black text-gray-900">صورة الغلاف</h3>
        <p class="text-xs text-gray-500 mt-1">صورة مستقلة تظهر في بطاقة المشروع وأعلى صفحة التفاصيل. الحد الأقصى 7 ميغابايت.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
        <input type="file" id="image" name="image" accept="image/*" class="w-full text-xs text-gray-500 file:ml-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
        @if ($project)
            <div>
                <span class="block text-[10px] font-bold text-gray-400 mb-2">الغلاف الحالي</span>
                <img src="{{ $project->image_url }}" alt="" class="h-32 w-52 rounded-xl object-cover border border-gray-200">
            </div>
        @endif
    </div>
</section>

<section class="space-y-5 pt-6 border-t border-gray-100">
    <div>
        <h3 class="font-black text-gray-900">معرض صور المشروع</h3>
        <p class="text-xs text-gray-500 mt-1">لكل صورة وصف باللغتين ورقم ترتيب. الرقم الأصغر يظهر أولًا.</p>
    </div>

    @if ($project?->images?->isNotEmpty())
        <div class="space-y-4">
            @foreach ($project->images as $galleryImage)
                <div class="grid grid-cols-1 md:grid-cols-[120px_1fr_1fr_90px] gap-4 items-start rounded-xl border border-gray-200 bg-gray-50 p-4">
                    <img src="{{ $galleryImage->image_url }}" alt="" class="w-full h-24 object-cover rounded-lg">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 mb-1">الوصف العربي</label>
                        <textarea name="existing_caption_ar[{{ $galleryImage->id }}]" rows="3" class="{{ $inputClass }}">{{ old('existing_caption_ar.'.$galleryImage->id, $galleryImage->caption_ar) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 mb-1">English caption</label>
                        <textarea name="existing_caption_en[{{ $galleryImage->id }}]" rows="3" dir="ltr" class="{{ $inputClass }} text-left">{{ old('existing_caption_en.'.$galleryImage->id, $galleryImage->caption_en) }}</textarea>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-[10px] font-bold text-gray-500">الترتيب
                            <input type="number" min="0" name="existing_order[{{ $galleryImage->id }}]" value="{{ old('existing_order.'.$galleryImage->id, $galleryImage->order) }}" class="{{ $inputClass }} mt-1">
                        </label>
                        <label class="flex items-center gap-2 text-xs font-bold text-red-600">
                            <input type="checkbox" name="remove_gallery[{{ $galleryImage->id }}]" value="1" class="accent-[#e11d26]">
                            حذف
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div id="newGalleryRows" class="space-y-4"></div>
    <button type="button" id="addGalleryImage" class="inline-flex items-center gap-2 rounded-xl bg-gray-100 hover:bg-gray-200 px-4 py-2.5 text-sm font-bold text-gray-800 transition-colors">
        <span class="text-lg leading-none">+</span> إضافة صورة للمعرض
    </button>
</section>

<section class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center pt-6 border-t border-gray-100">
    <div>
        <label for="order" class="block text-xs font-bold text-gray-700 mb-2">ترتيب المشروع في القائمة</label>
        <input type="number" min="0" id="order" name="order" value="{{ old('order', $project?->order ?? 0) }}" required class="{{ $inputClass }}">
    </div>
    <label class="flex items-center gap-2 cursor-pointer select-none md:mt-6">
        <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $project?->is_active ?? true)) class="w-4 h-4 accent-[#e11d26]">
        <span class="text-sm text-gray-700 font-bold">نشط ويظهر للزوار</span>
    </label>
</section>

<div class="pt-5 border-t border-gray-100 flex justify-start">
    <button type="submit" class="bg-brand hover:bg-red-700 text-white font-bold py-3 px-7 rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
        {{ $submitLabel }}
    </button>
</div>

@push('scripts')
<script>
    (() => {
        const container = document.getElementById('newGalleryRows');
        const addButton = document.getElementById('addGalleryImage');
        let galleryIndex = 0;

        function addGalleryRow() {
            const index = galleryIndex++;
            const row = document.createElement('div');
            row.className = 'grid grid-cols-1 md:grid-cols-[1fr_1fr_1fr_90px_auto] gap-4 items-end rounded-xl border border-dashed border-gray-300 bg-gray-50 p-4';
            row.innerHTML = `
                <label class="block text-[10px] font-bold text-gray-500">ملف الصورة
                    <input type="file" name="gallery_images[${index}]" accept="image/*" required class="mt-2 w-full text-xs text-gray-500 file:ml-2 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-white cursor-pointer">
                </label>
                <label class="block text-[10px] font-bold text-gray-500">الوصف العربي
                    <textarea name="gallery_caption_ar[${index}]" rows="2" class="mt-1 w-full bg-white rounded-xl px-3 py-2 text-sm border border-gray-200"></textarea>
                </label>
                <label class="block text-[10px] font-bold text-gray-500">English caption
                    <textarea name="gallery_caption_en[${index}]" rows="2" dir="ltr" class="mt-1 w-full bg-white rounded-xl px-3 py-2 text-sm text-left border border-gray-200"></textarea>
                </label>
                <label class="block text-[10px] font-bold text-gray-500">الترتيب
                    <input type="number" min="0" name="gallery_order[${index}]" value="${index}" class="mt-1 w-full bg-white rounded-xl px-3 py-2 text-sm border border-gray-200">
                </label>
                <button type="button" aria-label="حذف الصورة" class="remove-gallery-row rounded-lg bg-red-50 px-3 py-2 text-sm font-bold text-red-600 hover:bg-red-100">حذف</button>
            `;
            row.querySelector('.remove-gallery-row').addEventListener('click', () => row.remove());
            container.appendChild(row);
        }

        addButton?.addEventListener('click', addGalleryRow);
    })();
</script>
@endpush
