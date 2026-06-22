@extends('layouts.admin')

@section('title', 'إضافة خبر')
@section('page_title', 'إضافة خبر جديد للمركز الإعلامي')

@section('admin_content')

    <div class="max-w-4xl mx-auto space-y-6">
        <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-xs font-bold text-gray-700 mb-2">عنوان الخبر</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-xs font-bold text-gray-700 mb-2">تصنيف الخبر</label>
                    <select id="category_id" name="category_id" required
                            class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                        <option value="">-- اختر التصنيف --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-xs font-bold text-gray-700 mb-2">الرابط الفريد (Slug - يترك فارغاً للتوليد التلقائي)</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="news-slug-example"
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all text-left" dir="ltr">
                </div>

                <!-- Published At -->
                <div>
                    <label for="published_at" class="block text-xs font-bold text-gray-700 mb-2">تاريخ النشر (اختياري، القيمة الافتراضية الآن)</label>
                    <input type="date" id="published_at" name="published_at" value="{{ old('published_at') }}"
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>
            </div>

            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-xs font-bold text-gray-700 mb-2">ملخص الخبر (يظهر في القائمة العامة)</label>
                <textarea id="excerpt" name="excerpt" rows="2" placeholder="اكتب ملخصاً قصيراً وجذاباً للخبر هنا..."
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('excerpt') }}</textarea>
            </div>

            <!-- Body -->
            <div>
                <label for="body" class="block text-xs font-bold text-gray-700 mb-2">محتوى الخبر بالتفصيل</label>
                <textarea id="body" name="body" rows="10" required placeholder="اكتب تفاصيل الخبر هنا، يمكنك استخدام الفقرات والسطور الجديدة..."
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-y">{{ old('body') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <!-- Image File -->
                <div>
                    <label for="image" class="block text-xs font-bold text-gray-700 mb-2">صورة الخبر الرئيسيّة</label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                </div>

                <!-- Order and Published Checkbox -->
                <div class="grid grid-cols-2 gap-4 items-center">
                    <div>
                        <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب</label>
                        <input type="number" id="order" name="order" value="{{ old('order', 0) }}" required
                               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                    </div>
                    
                    <div class="flex items-center gap-2 cursor-pointer select-none mt-6">
                        <input type="checkbox" id="is_published" name="is_published" value="1" checked class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
                        <label for="is_published" class="text-xs text-gray-700 font-bold">نشر الآن ويظهر للعموم</label>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="pt-4 border-t border-gray-100 flex justify-start">
                <button type="submit" class="bg-brand hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
                    إضافة الخبر
                </button>
            </div>
        </form>
    </div>

@endsection
