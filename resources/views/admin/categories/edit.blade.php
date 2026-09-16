@extends('layouts.admin')

@section('title', 'تعديل التصنيف')
@section('page_title', 'تعديل التصنيف')

@section('admin_content')

    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-700 mb-2">اسم التصنيف (بالعربية)</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-xs font-bold text-gray-700 mb-2">الرابط الفريد (Slug - اختياري، يترك فارغاً للتوليد التلقائي)</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" placeholder="مثال: custom-slug"
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all text-left" dir="ltr">
                </div>
            </div>

            <div dir="ltr" class="text-left">
                <label for="name_en" class="block text-xs font-bold text-gray-700 mb-2">Category name — English</label>
                <input type="text" id="name_en" name="name_en" value="{{ old('name_en', $category->name_en) }}" required
                       class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Type -->
                <div>
                    <label for="type" class="block text-xs font-bold text-gray-700 mb-2">نوع التصنيف</label>
                    <select id="type" name="type" required
                            class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                        <option value="project" {{ old('type', $category->type) === 'project' ? 'selected' : '' }}>معرض المشاريع</option>
                        <option value="news" {{ old('type', $category->type) === 'news' ? 'selected' : '' }}>المركز الإعلامي (الأخبار)</option>
                    </select>
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $category->order) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
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
