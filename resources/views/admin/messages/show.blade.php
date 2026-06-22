@extends('layouts.admin')

@section('title', 'عرض الرسالة')
@section('page_title', 'تفاصيل رسالة تواصل')

@section('admin_content')

    <div class="max-w-3xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                <span>العودة لقائمة الرسائل</span>
            </a>
            
            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذه الرسالة نهائياً؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-50 hover:bg-red-100 text-brand rounded-xl px-5 py-2.5 text-sm font-bold transition-all">
                    حذف الرسالة
                </button>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            <!-- Metadata -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-gray-100">
                <div>
                    <span class="text-xs text-gray-400 font-bold block mb-1">المرسل</span>
                    <span class="text-base font-bold text-gray-900">{{ $message->name }}</span>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-bold block mb-1">رقم الهاتف</span>
                    <a href="tel:{{ $message->phone }}" class="text-base font-bold text-brand hover:underline" dir="ltr">{{ $message->phone }}</a>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-bold block mb-1">البريد الإلكتروني</span>
                    @if ($message->email)
                        <a href="mailto:{{ $message->email }}" class="text-base font-bold text-brand hover:underline">{{ $message->email }}</a>
                    @else
                        <span class="text-sm text-gray-400 italic">غير متوفر</span>
                    @endif
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-bold block mb-1">القسم المستهدف</span>
                    <span class="text-base font-medium text-gray-700">{{ $message->department_name }} ({{ $message->department_email }})</span>
                </div>
            </div>

            <!-- Subject & Content -->
            <div class="space-y-4">
                <div>
                    <span class="text-xs text-gray-400 font-bold block mb-1">الموضوع</span>
                    <h3 class="text-lg font-black text-gray-900">{{ $message->subject }}</h3>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-bold block mb-1">نص الرسالة</span>
                    <div class="bg-gray-50 rounded-2xl p-5 text-gray-800 leading-relaxed whitespace-pre-wrap border border-gray-100">{{ $message->message }}</div>
                </div>
            </div>
            
            <div class="pt-4 text-xs text-gray-400 font-bold">
                تاريخ الإرسال: {{ $message->created_at->translatedFormat('l, j F Y - H:i') }}
            </div>
        </div>
    </div>

@endsection
