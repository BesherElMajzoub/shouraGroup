@extends('layouts.admin')

@section('title', 'الفروع')
@section('page_title', 'إدارة الفروع وصالات العرض')

@section('admin_content')

    <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-black text-gray-900">قائمة الفروع</h3>
        <a href="{{ route('admin.branches.create') }}" class="bg-brand hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-brand/20 transition-all">
            إضافة فرع جديد
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500">
                        <th class="px-6 py-4">الفرع</th>
                        <th class="px-6 py-4">العنوان</th>
                        <th class="px-6 py-4">الهاتف / الجوال</th>
                        <th class="px-6 py-4">موضع الخريطة</th>
                        <th class="px-6 py-4">الحالة</th>
                        <th class="px-6 py-4 text-center">العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($branches as $branch)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $branch->name }}</div>
                                @if ($branch->description)
                                    <div class="text-xs text-gray-400">{{ $branch->description }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $branch->address }}</td>
                            <td class="px-6 py-4 text-gray-600 text-xs" dir="ltr">
                                <div>{{ $branch->phone ?: '—' }}</div>
                                @if ($branch->mobile)
                                    <div class="text-gray-400">{{ $branch->mobile }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-mono text-xs" dir="ltr">{{ $branch->map_top }}% / {{ $branch->map_left }}%</td>
                            <td class="px-6 py-4">
                                @if ($branch->is_active)
                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">نشط</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-50 px-2.5 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">معطل</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <a href="{{ route('admin.branches.edit', $branch->id) }}" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.branches.destroy', $branch->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا الفرع؟')">
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
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-bold">لا توجد فروع مضافة حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
