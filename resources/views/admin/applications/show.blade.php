@extends('layouts.admin')

@section('title', 'تفاصيل طلب توظيف')
@section('page_title', 'تفاصيل طلب التوظيف')

@section('admin_content')

    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden text-right">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between gap-4">
                <div>
                    <h3 class="font-black text-gray-900 text-lg">{{ $application->full_name }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $application->created_at->translatedFormat('j F Y — H:i') }}</p>
                </div>
                @if ($application->cv_url)
                    <a href="{{ $application->cv_url }}" target="_blank"
                       class="shrink-0 inline-flex items-center gap-2 bg-brand hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-brand/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4v12m0 0-4-4m4 4 4-4M4 20h16"/></svg>
                        تحميل السيرة الذاتية
                    </a>
                @endif
            </div>

            <dl class="divide-y divide-gray-100 text-sm">
                @foreach ([
                    ['رقم الهاتف', $application->phone, true],
                    ['البريد الإلكتروني', $application->email ?: 'غير متوفر', true],
                    ['المجال الوظيفي المفضل', $application->department, false],
                    ['فرع العمل المفضل', $application->preferred_branch, false],
                ] as [$label, $value, $ltr])
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-xs font-bold text-gray-500">{{ $label }}</dt>
                        <dd class="col-span-2 text-gray-900 font-medium" @if ($ltr) dir="ltr" @endif>{{ $value }}</dd>
                    </div>
                @endforeach

                <div class="px-6 py-4">
                    <dt class="text-xs font-bold text-gray-500 mb-2">نبذة عن الخبرات</dt>
                    <dd class="text-gray-900 leading-loose whitespace-pre-line bg-gray-50 rounded-xl p-4">{{ $application->cover_letter ?: 'لا يوجد' }}</dd>
                </div>
            </dl>

            <div class="p-6 border-t border-gray-100 flex items-center gap-3">
                <form action="{{ route('admin.applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('سيتم حذف الطلب والسيرة الذاتية نهائياً. هل أنت متأكد؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-brand rounded-xl px-5 py-2.5 text-sm font-bold transition-all">
                        حذف الطلب
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
