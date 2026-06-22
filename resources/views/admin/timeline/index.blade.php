@extends('layouts.admin')

@section('title', 'خط زمن المجموعة')
@section('page_title', 'إدارة أحداث خط زمن المجموعة')

@section('admin_content')

    <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-black text-gray-900">أحداث الخط الزمني للمجموعة</h3>
        <a href="{{ route('admin.timeline.create') }}" class="bg-brand hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-brand/20 transition-all">
            إضافة حدث جديد
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500">
                        <th class="px-6 py-4">التاريخ / السنة</th>
                        <th class="px-6 py-4">العنوان</th>
                        <th class="px-6 py-4">الوصف</th>
                        <th class="px-6 py-4">الترتيب</th>
                        <th class="px-6 py-4 text-center">العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($nodes as $node)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-bold text-brand">{{ $node->event_date }}</td>
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $node->title }}</td>
                            <td class="px-6 py-4 text-gray-600 max-w-md truncate">{{ $node->description }}</td>
                            <td class="px-6 py-4 text-gray-500 font-semibold">{{ $node->order }}</td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <a href="{{ route('admin.timeline.edit', $node->id) }}" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.timeline.destroy', $node->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا الحدث من الخط الزمني؟')">
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
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 font-bold">لا يوجد أي أحداث مضافة في الخط الزمني حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
