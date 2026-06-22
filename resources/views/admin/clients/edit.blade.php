@extends('layouts.admin')

@section('title', 'تعديل شريك نجاح')
@section('page_title', 'تعديل شريك نجاح')

@section('admin_content')

    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('admin.clients.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-700 mb-2">اسم الشريك / العميل</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $client->name) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-xs font-bold text-gray-700 mb-2">الترتيب</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $client->order) }}" required
                           class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <!-- Current and New Logo -->
                <div class="space-y-4">
                    <label for="logo" class="block text-xs font-bold text-gray-700">شعار الشريك (اختر ملفاً فقط إذا أردت الاستبدال)</label>
                    <input type="file" id="logo" name="logo" accept="image/*"
                           class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                    
                    <div class="mt-2">
                        <span class="block text-[10px] font-bold text-gray-400 mb-1">الشعار الحالي:</span>
                        <div class="h-16 w-32 bg-gray-50 border border-gray-200 rounded-xl p-1 flex items-center justify-center">
                            <img src="{{ $client->logo_url }}" alt="" class="max-h-full max-w-full object-contain">
                        </div>
                    </div>
                </div>

                <!-- Active Checkbox -->
                <div class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ $client->is_active ? 'checked' : '' }} class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
                    <label for="is_active" class="text-xs text-gray-700 font-bold">نشط ويظهر في شريط العملاء بالموقع</label>
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
