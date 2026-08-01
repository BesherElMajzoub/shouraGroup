@extends('layouts.admin')

@section('title', 'العلامات التجارية')
@section('page_title', 'إدارة العلامات التجارية والوكالات')

@section('admin_content')

    <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-black text-gray-900">قائمة العلامات التجارية</h3>
        <a href="{{ route('admin.brands.create') }}" class="bg-brand hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-brand/20 transition-all">
            إضافة علامة جديدة
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500">
                        <th class="px-6 py-4">الشعار</th>
                        <th class="px-6 py-4">الاسم</th>
                        <th class="px-6 py-4">القطاعات</th>
                        <th class="px-6 py-4">النوع</th>
                        <th class="px-6 py-4">الترتيب</th>
                        <th class="px-6 py-4 text-center">العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($brands as $brand)
                        <tr class="hover:bg-gray-50/50 {{ $brand->is_active ? '' : 'opacity-50' }}">
                            <td class="px-6 py-4">
                                <div class="h-12 w-24 bg-gray-50 rounded-lg overflow-hidden p-1 shadow-sm border border-gray-100 flex items-center justify-center">
                                    @if ($brand->logo_url)
                                        <img src="{{ $brand->logo_url }}" alt="" class="max-h-full max-w-full object-contain">
                                    @else
                                        <span class="text-[10px] font-bold text-amber-600 text-center leading-tight px-1">بدون شعار</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $brand->name }}</div>
                                @if ($brand->country)
                                    <div class="text-xs text-gray-400">{{ $brand->country }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1 max-w-xs">
                                    @forelse ($brand->sectors as $s)
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-[10px] font-medium text-gray-600">{{ $s->name }}</span>
                                    @empty
                                        <span class="text-xs text-gray-300">—</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1 items-start">
                                    @if ($brand->is_agency)
                                        <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-brand ring-1 ring-inset ring-red-600/20">وكالة رسمية</span>
                                    @endif
                                    @if ($brand->show_on_home)
                                        <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-[10px] font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">في الرئيسية</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-semibold">{{ $brand->order }}</td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذه العلامة التجارية؟')">
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
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-bold">لا توجد علامات تجارية مضافة حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
