@extends('layouts.admin')

@section('title', 'معرض المشاريع')
@section('page_title', 'إدارة معرض المشاريع')

@section('admin_content')

    <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-black text-gray-900">المشاريع المنجزة والجاري تنفيذها</h3>
        <a href="{{ route('admin.projects.create') }}" class="bg-brand hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-brand/20 transition-all">
            إضافة مشروع جديد
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500">
                        <th class="px-6 py-4">صورة المشروع</th>
                        <th class="px-6 py-4">المشروع</th>
                        <th class="px-6 py-4">التصنيف</th>
                        <th class="px-6 py-4">العميل / السنة</th>
                        <th class="px-6 py-4">الترتيب</th>
                        <th class="px-6 py-4">الحالة</th>
                        <th class="px-6 py-4 text-center">العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($projects as $project)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-4">
                                <div class="h-12 w-20 rounded-lg overflow-hidden shadow-sm border border-gray-100">
                                    <img src="{{ $project->image_url }}" alt="" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $project->title }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-bold text-blue-700 ring-1 ring-inset ring-blue-600/20">
                                    {{ $project->category->name ?? 'غير مصنف' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 font-medium">
                                <div class="text-xs">{{ $project->client ?? 'غير محدد' }}</div>
                                <div class="text-[10px] text-gray-400 font-bold mt-0.5">{{ $project->year ?? 'غير محدد' }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-semibold">{{ $project->order }}</td>
                            <td class="px-6 py-4">
                                @if ($project->is_active)
                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">نشط</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-50 px-2.5 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">معطل</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا المشروع نهائياً؟')">
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
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-bold">لا يوجد أي مشاريع مضافة حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
