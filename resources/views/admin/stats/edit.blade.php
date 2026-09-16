@extends('layouts.admin')

@section('title', 'تعديل إحصائية')
@section('page_title', 'تعديل رقم إحصائي')

@section('admin_content')

    <div class="max-w-2xl mx-auto space-y-6">
        <a href="{{ route('admin.stats.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <form action="{{ route('admin.stats.update', $stat->id) }}" method="POST" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Value -->
                <div>
                    <label for="value" class="block text-xs font-bold text-gray-700 mb-2">القيمة الرقمية (مثل: +45, 100%, 15+)</label>
                    <input type="text" id="value" name="value" value="{{ old('value', $stat->value) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $stat->order) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>
            </div>

            <div dir="ltr" class="text-left">
                <label for="label_en" class="block text-xs font-bold text-gray-700 mb-2">Label — English</label>
                <input type="text" id="label_en" name="label_en" value="{{ old('label_en', $stat->label_en) }}" required
                       class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand">
            </div>

            <!-- Label -->
            <div>
                <label for="label" class="block text-xs font-bold text-gray-700 mb-2">الوصف / النص المصاحب (مثل: عاماً من الخبرة)</label>
                <input type="text" id="label" name="label" value="{{ old('label', $stat->label) }}" required
                       class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
            </div>

            <!-- Active Checkbox -->
            <div class="flex items-center gap-2 cursor-pointer select-none">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ $stat->is_active ? 'checked' : '' }} class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
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
