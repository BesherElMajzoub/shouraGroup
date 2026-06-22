@extends('layouts.admin')

@section('title', 'صندوق الرسائل')
@section('page_title', 'رسائل تواصل معنا الواردة')

@section('admin_content')

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-black text-gray-900 text-base">قائمة الرسائل</h3>
            <span class="text-xs text-gray-500 font-medium">إجمالي الرسائل: {{ $messages->total() }}</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500">
                        <th class="px-6 py-4">المرسل</th>
                        <th class="px-6 py-4">رقم الهاتف</th>
                        <th class="px-6 py-4">القسم الموجه إليه</th>
                        <th class="px-6 py-4">الموضوع</th>
                        <th class="px-6 py-4">تاريخ الإرسال</th>
                        <th class="px-6 py-4">الحالة</th>
                        <th class="px-6 py-4 text-center">العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($messages as $msg)
                        <tr class="hover:bg-gray-50/50 {{ !$msg->is_read ? 'bg-red-50/10' : '' }}">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $msg->name }}</td>
                            <td class="px-6 py-4 text-gray-600" dir="ltr text-right">{{ $msg->phone }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $msg->department_name }}</td>
                            <td class="px-6 py-4 text-gray-900 font-medium">{{ $msg->subject }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $msg->created_at->translatedFormat('j M Y, H:i') }}</td>
                            <td class="px-6 py-4">
                                @if ($msg->is_read)
                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">مقروءة</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-brand ring-1 ring-inset ring-red-600/20 font-bold animate-pulse">جديدة</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                    عرض
                                </a>
                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذه الرسالة نهائياً؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-brand rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-bold">لا يوجد أي رسائل واردة حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($messages->hasPages())
            <div class="p-6 border-t border-gray-100 flex justify-center">
                {{ $messages->links() }}
            </div>
        @endif
    </div>

@endsection
