@extends('layouts.admin')

@section('title', 'القطاعات')
@section('page_title', 'إدارة قطاعات العمل')

@section('admin_content')

    <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-black text-gray-900">قائمة القطاعات</h3>
        <a href="{{ route('admin.sectors.create') }}" class="bg-brand hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-brand/20 transition-all">
            إضافة قطاع جديد
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500">
                        <th class="px-6 py-4">القطاع</th>
                        <th class="px-6 py-4">المعرّف (الرابط)</th>
                        <th class="px-6 py-4">العلامات</th>
                        <th class="px-6 py-4">الترتيب</th>
                        <th class="px-6 py-4">الحالة</th>
                        <th class="px-6 py-4 text-center">العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($sectors as $sector)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="shrink-0 w-10 h-10 rounded-xl bg-red-50 text-brand grid place-items-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $sector->icon }}"/></svg>
                                    </span>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $sector->name }}</div>
                                        @if ($sector->tagline)
                                            <div class="text-xs text-gray-400">{{ $sector->tagline }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-mono text-xs" dir="ltr">{{ $sector->slug }}</td>
                            <td class="px-6 py-4 text-gray-500 font-semibold">{{ $sector->brands_count }}</td>
                            <td class="px-6 py-4 text-gray-500 font-semibold">{{ $sector->order }}</td>
                            <td class="px-6 py-4">
                                @if ($sector->is_coming_soon)
                                    <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-600/20">قريباً</span>
                                @elseif ($sector->is_active)
                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">نشط</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-50 px-2.5 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">معطل</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <a href="{{ route('admin.sectors.edit', $sector->id) }}" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.sectors.destroy', $sector->id) }}" method="POST" onsubmit="return confirm('حذف القطاع سيحذف أيضاً ارتباطه بالعلامات التجارية. هل أنت متأكد؟')">
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
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-bold">لا توجد قطاعات مضافة حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
