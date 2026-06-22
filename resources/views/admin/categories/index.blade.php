@extends('layouts.admin')

@section('title', 'التصنيفات')
@section('page_title', 'إدارة تصنيفات المشاريع والأخبار')

@section('admin_content')

    <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-black text-gray-900">قائمة التصنيفات</h3>
        <a href="{{ route('admin.categories.create') }}" class="bg-brand hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-brand/20 transition-all">
            إضافة تصنيف جديد
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500">
                        <th class="px-6 py-4">النوع</th>
                        <th class="px-6 py-4">اسم التصنيف</th>
                        <th class="px-6 py-4">الرابط الفريد (Slug)</th>
                        <th class="px-6 py-4">الترتيب</th>
                        <th class="px-6 py-4">عدد العناصر المرتبطة</th>
                        <th class="px-6 py-4 text-center">العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-4">
                                @if ($category->type === 'project')
                                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-bold text-blue-700 ring-1 ring-inset ring-blue-600/20">معرض المشاريع</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-purple-50 px-2.5 py-0.5 text-xs font-bold text-purple-700 ring-1 ring-inset ring-purple-600/20">المركز الإعلامي</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-gray-500 font-mono text-xs">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-gray-500 font-semibold">{{ $category->order }}</td>
                            <td class="px-6 py-4 text-gray-600 font-medium">
                                @if ($category->type === 'project')
                                    {{ $category->projects()->count() }} مشروعاً
                                @else
                                    {{ $category->news()->count() }} خبراً
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا التصنيف؟ لا يمكن التراجع عن هذا الإجراء.')">
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
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-bold">لا يوجد أي تصنيفات مضافة حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
