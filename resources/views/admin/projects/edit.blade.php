@extends('layouts.admin')

@section('title', 'تعديل المشروع')
@section('page_title', 'تعديل المشروع')

@section('admin_content')

    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-xs font-bold text-gray-700 mb-2">عنوان المشروع</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-xs font-bold text-gray-700 mb-2">تصنيف المشروع</label>
                    <select id="category_id" name="category_id" required
                            class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                        <option value="">-- اختر التصنيف --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Client -->
                <div>
                    <label for="client" class="block text-xs font-bold text-gray-700 mb-2">العميل</label>
                    <input type="text" id="client" name="client" value="{{ old('client', $project->client) }}" placeholder="مثال: شركة س ص"
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-xs font-bold text-gray-700 mb-2">الموقع</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $project->location) }}" placeholder="مثال: الرياض"
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Year -->
                <div>
                    <label for="year" class="block text-xs font-bold text-gray-700 mb-2">السنة</label>
                    <input type="text" id="year" name="year" value="{{ old('year', $project->year) }}" placeholder="مثال: 2026"
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold text-gray-700 mb-2">وصف / تفاصيل المشروع</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <!-- Image File & Current Preview -->
                <div class="space-y-4">
                    <label for="image" class="block text-xs font-bold text-gray-700">صورة المشروع الرئيسية (اختر ملفاً فقط إذا أردت استبدالها)</label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                    
                    <div class="mt-2">
                        <span class="block text-[10px] font-bold text-gray-400 mb-1">الصورة الحالية:</span>
                        <div class="h-24 w-36 border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                            <img src="{{ $project->image_url }}" alt="" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Order and Active Checkbox -->
                <div class="grid grid-cols-2 gap-4 items-center">
                    <div>
                        <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب</label>
                        <input type="number" id="order" name="order" value="{{ old('order', $project->order) }}" required
                               class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                    </div>
                    
                    <div class="flex items-center gap-2 cursor-pointer select-none mt-6">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ $project->is_active ? 'checked' : '' }} class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
                        <label for="is_active" class="text-xs text-gray-700 font-bold">نشط ويظهر في المعرض</label>
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
