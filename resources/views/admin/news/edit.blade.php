@extends('layouts.admin')

@section('title', 'تعديل الخبر')
@section('page_title', 'تعديل الخبر')

@section('admin_content')

    <div class="max-w-4xl mx-auto space-y-6">
        <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title (Arabic) -->
                <div>
                    <label for="title_ar" class="block text-xs font-bold text-gray-700 mb-2">عنوان الخبر (عربي)</label>
                    <input type="text" id="title_ar" name="title_ar" value="{{ old('title_ar', $news->title_ar) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Title (English) -->
                <div>
                    <label for="title_en" class="block text-xs font-bold text-gray-700 mb-2">عنوان الخبر (English) <span class="text-brand">*</span></label>
                    <input type="text" id="title_en" name="title_en" value="{{ old('title_en', $news->title_en) }}" dir="ltr" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all text-left">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-xs font-bold text-gray-700 mb-2">تصنيف الخبر</label>
                    <select id="category_id" name="category_id" required
                            class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                        <option value="">-- اختر التصنيف --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-xs font-bold text-gray-700 mb-2">الرابط الفريد (Slug - يترك فارغاً للتوليد التلقائي)</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $news->slug) }}" placeholder="news-slug-example"
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all text-left" dir="ltr">
                </div>
            </div>

            <!-- Published At -->
            <div>
                <label for="published_at" class="block text-xs font-bold text-gray-700 mb-2">تاريخ النشر (اختياري)</label>
                <input type="date" id="published_at" name="published_at" value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d') : '') }}"
                       class="w-full md:w-1/2 bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
            </div>

            <!-- Excerpt (Arabic) -->
            <div>
                <label for="excerpt_ar" class="block text-xs font-bold text-gray-700 mb-2">ملخص الخبر (عربي — يظهر في القائمة العامة)</label>
                <textarea id="excerpt_ar" name="excerpt_ar" rows="2" placeholder="اكتب ملخصاً قصيراً وجذاباً للخبر هنا..."
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('excerpt_ar', $news->excerpt_ar) }}</textarea>
            </div>

            <!-- Excerpt (English) -->
            <div>
                <label for="excerpt_en" class="block text-xs font-bold text-gray-700 mb-2">ملخص الخبر (English)</label>
                <textarea id="excerpt_en" name="excerpt_en" rows="2" dir="ltr" placeholder="Short, engaging summary in English..."
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none text-left">{{ old('excerpt_en', $news->excerpt_en) }}</textarea>
            </div>

            <!-- Body (Arabic) -->
            <div>
                <label for="body_ar" class="block text-xs font-bold text-gray-700 mb-2">محتوى الخبر بالتفصيل (عربي)</label>
                <textarea id="body_ar" name="body_ar" rows="10" required placeholder="اكتب تفاصيل الخبر هنا، يمكنك استخدام الفقرات والسطور الجديدة..."
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-y">{{ old('body_ar', $news->body_ar) }}</textarea>
            </div>

            <!-- Body (English) -->
            <div>
                <label for="body_en" class="block text-xs font-bold text-gray-700 mb-2">محتوى الخبر بالتفصيل (English) <span class="text-brand">*</span></label>
                <textarea id="body_en" name="body_en" rows="10" dir="ltr" required placeholder="Write the full article in English here..."
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-y text-left">{{ old('body_en', $news->body_en) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <!-- Image File & Current Preview -->
                <div class="space-y-4">
                    <label for="image" class="block text-xs font-bold text-gray-700">صورة الخبر الرئيسية (اختر ملفاً فقط إذا أردت استبدالها)</label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                    
                    <div class="mt-2">
                        <span class="block text-[10px] font-bold text-gray-400 mb-1">الصورة الحالية:</span>
                        <div class="h-24 w-36 border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                            <img src="{{ $news->image_url }}" alt="" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Order and Published Checkbox -->
                <div class="grid grid-cols-2 gap-4 items-center">
                    <div>
                        <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب</label>
                        <input type="number" id="order" name="order" value="{{ old('order', $news->order) }}" required
                               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                    </div>
                    
                    <div class="flex items-center gap-2 cursor-pointer select-none mt-6">
                        <input type="checkbox" id="is_published" name="is_published" value="1" {{ $news->is_published ? 'checked' : '' }} class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
                        <label for="is_published" class="text-xs text-gray-700 font-bold">نشر الآن ويظهر للعموم</label>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="pt-4 border-t border-gray-100 flex justify-start">
                <button type="submit" class="bg-brand hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>

@endsection
