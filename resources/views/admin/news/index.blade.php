@extends('layouts.admin')

@section('title', 'المركز الإعلامي')
@section('page_title', 'إدارة أخبار المجموعة')

@section('admin_content')

    <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-black text-gray-900">أخبار وفعاليات المجموعة</h3>
        <a href="{{ route('admin.news.create') }}" class="bg-brand hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-brand/20 transition-all">
            إضافة خبر جديد
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500">
                        <th class="px-6 py-4">صورة الخبر</th>
                        <th class="px-6 py-4">الخبر</th>
                        <th class="px-6 py-4">التصنيف</th>
                        <th class="px-6 py-4">تاريخ النشر</th>
                        <th class="px-6 py-4">الترتيب</th>
                        <th class="px-6 py-4">الحالة</th>
                        <th class="px-6 py-4 text-center">العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($news as $item)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-4">
                                <div class="h-12 w-20 rounded-lg overflow-hidden shadow-sm border border-gray-100">
                                    <img src="{{ $item->image_url }}" alt="" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900">
                                <div class="line-clamp-1 max-w-xs">{{ $item->title_ar }}</div>
                                <div class="text-xs text-gray-400 font-normal line-clamp-1 mt-0.5">{{ $item->excerpt_ar }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-purple-50 px-2.5 py-0.5 text-xs font-bold text-purple-700 ring-1 ring-inset ring-purple-600/20">
                                    {{ $item->category->name ?? 'غير مصنف' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-semibold">{{ $item->published_at ? $item->published_at->format('Y-m-d') : '-' }}</td>
                            <td class="px-6 py-4 text-gray-500 font-semibold">{{ $item->order }}</td>
                            <td class="px-6 py-4">
                                @if ($item->is_published)
                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">منشور</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-50 px-2.5 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">مسودة</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا الخبر نهائياً؟')">
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
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-bold">لا يوجد أي أخبار مضافة حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
