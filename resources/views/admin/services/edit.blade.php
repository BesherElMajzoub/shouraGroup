@extends('layouts.admin')

@section('title', 'تعديل خدمة')
@section('page_title', 'تعديل خدمة أو حل هندسي')

@section('admin_content')

    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-xs font-bold text-gray-700 mb-2">اسم الخدمة</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Dept -->
                <div>
                    <label for="dept" class="block text-xs font-bold text-gray-700 mb-2">القسم المختص (يستخدم عند طلب الخدمة لتحديد البريد)</label>
                    <input type="text" id="dept" name="dept" value="{{ old('dept', $service->dept) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold text-gray-700 mb-2">شرح / وصف الخدمة بالتفصيل</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('description', $service->description) }}</textarea>
            </div>

            <!-- Features list (one per line) -->
            <div>
                <label for="features_text" class="block text-xs font-bold text-gray-700 mb-2">قائمة الميزات والحلول التفصيلية (كل ميزة في سطر منفصل)</label>
                <textarea id="features_text" name="features_text" rows="5" placeholder="أدخل هنا ميزات الخدمة، ميزة في كل سطر..."
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('features_text', $features_text) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Icon (SVG path) -->
                <div>
                    <label for="icon" class="block text-xs font-bold text-gray-700 mb-2">مسار أيقونة الـ SVG (الخاص بـ path d=)</label>
                    <input type="text" id="icon" name="icon" value="{{ old('icon', $service->icon) }}" placeholder="M12 3..."
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all text-left" dir="ltr">
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $service->order) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>
            </div>

            <!-- Image preview & update -->
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-2">صورة الخدمة الحالية</label>
                <div class="flex items-center gap-4 flex-wrap">
                    <div class="h-24 w-40 rounded-xl overflow-hidden shadow-sm border border-gray-200 bg-gray-50">
                        <img src="{{ $service->image_url }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <input type="file" id="image" name="image" accept="image/*"
                               class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                        <span class="text-[10px] text-gray-400 block mt-1">تحديد ملف جديد سيقوم باستبدال الصورة القديمة.</span>
                    </div>
                </div>
            </div>

            <!-- Active Checkbox -->
            <div class="flex items-center gap-2 cursor-pointer select-none">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }} class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
                <label for="is_active" class="text-xs text-gray-700 font-bold">نشط ويظهر في الموقع العام</label>
            </div>

            <!-- Action buttons -->
            <div class="pt-4 border-t border-gray-100 flex justify-start">
                <button type="submit" class="bg-brand hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>

@endsection
