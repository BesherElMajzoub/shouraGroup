@extends('layouts.admin')

@section('title', 'تعديل فرع')
@section('page_title', 'تعديل فرع: ' . $branch->name)

@section('admin_content')

    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('admin.branches.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <form action="{{ route('admin.branches.update', $branch->id) }}" method="POST"
              class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            @method('PUT')

            @include('admin.branches._form')

            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <button type="submit" class="bg-brand hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
                    حفظ التغييرات
                </button>
                <a href="{{ url('/contact') }}" target="_blank"
                   class="text-sm font-bold text-gray-500 hover:text-brand transition-colors">معاينة صفحة اتصل بنا ↗</a>
            </div>
        </form>
    </div>

@endsection
