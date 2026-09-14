@extends('layouts.admin')

@section('title', 'إضافة خدمة')
@section('page_title', 'إضافة خدمة أو حل هندسي جديد')

@section('admin_content')

    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-xs font-bold text-gray-700 mb-2">اسم الخدمة</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Dept -->
                <div>
                    <label for="dept" class="block text-xs font-bold text-gray-700 mb-2">القسم المختص (يستخدم عند طلب الخدمة لتحديد البريد)</label>
                    <input type="text" id="dept" name="dept" value="{{ old('dept') }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>
            </div>

            <!-- Group -->
            <div>
                <label for="group" class="block text-xs font-bold text-gray-700 mb-2">مكان عرض الخدمة</label>
                <select id="group" name="group" required
                        class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                    <option value="pillar" {{ old('group') === 'pillar' ? 'selected' : '' }}>خدمة تفصيلية في صفحة «خدماتنا وحلولنا»</option>
                    <option value="home" {{ old('group') === 'home' ? 'selected' : '' }}>بطاقة مختصرة في قسم «الخدمات والحلول» بالصفحة الرئيسية</option>
                </select>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold text-gray-700 mb-2">شرح / وصف الخدمة بالتفصيل</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('description') }}</textarea>
            </div>

            <!-- Features list (one per line) -->
            <div>
                <label for="features_text" class="block text-xs font-bold text-gray-700 mb-2">قائمة الميزات والحلول التفصيلية (كل ميزة في سطر منفصل)</label>
                <textarea id="features_text" name="features_text" rows="5" placeholder="أدخل هنا ميزات الخدمة، ميزة في كل سطر..."
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('features_text') }}</textarea>
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" required
                       class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <!-- Image file -->
                <div>
                    <label for="image" class="block text-xs font-bold text-gray-700 mb-2">صورة الخدمة</label>
                    <input type="file" id="image" name="image" accept="image/*" required
                           class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                </div>

                <!-- Active Checkbox -->
                <div class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" id="is_active" name="is_active" value="1" checked class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
                    <label for="is_active" class="text-xs text-gray-700 font-bold">نشط ويظهر في الموقع العام</label>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="pt-4 border-t border-gray-100 flex justify-start">
                <button type="submit" class="bg-brand hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
                    إضافة الخدمة
                </button>
            </div>
        </form>
    </div>

@endsection
