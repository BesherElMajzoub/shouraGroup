@extends('layouts.admin')

@section('title', 'إضافة حدث للخط الزمني')
@section('page_title', 'إضافة حدث جديد للخط الزمني')

@section('admin_content')

    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('admin.timeline.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <form action="{{ route('admin.timeline.store') }}" method="POST" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Event Date -->
                <div>
                    <label for="event_date" class="block text-xs font-bold text-gray-700 mb-2">السنة / التاريخ (مثال: 1980 أو 1995 - 2000)</label>
                    <input type="text" id="event_date" name="event_date" value="{{ old('event_date') }}" placeholder="1980" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-xs font-bold text-gray-700 mb-2">عنوان الحدث</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold text-gray-700 mb-2">الوصف بالتفصيل</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('description') }}</textarea>
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب في الخط الزمني</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" required
                       class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
            </div>

            <!-- Action buttons -->
            <div class="pt-4 border-t border-gray-100 flex justify-start">
                <button type="submit" class="bg-brand hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
                    إضافة الحدث
                </button>
            </div>
        </form>
    </div>

@endsection
