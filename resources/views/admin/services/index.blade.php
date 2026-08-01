@extends('layouts.admin')

@section('title', 'الخدمات والحلول')
@section('page_title', 'إدارة الخدمات والحلول')

@section('admin_content')

    <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-black text-gray-900">الخدمات والحلول المتاحة</h3>
        <a href="{{ route('admin.services.create') }}" class="bg-brand hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-brand/20 transition-all">
            إضافة خدمة جديدة
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500">
                        <th class="px-6 py-4">صورة الخدمة</th>
                        <th class="px-6 py-4">الخدمة</th>
                        <th class="px-6 py-4">القسم المختص</th>
                        <th class="px-6 py-4">الترتيب</th>
                        <th class="px-6 py-4">الميزات</th>
                        <th class="px-6 py-4">الحالة</th>
                        <th class="px-6 py-4 text-center">العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($services as $service)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-4">
                                <div class="h-12 w-20 rounded-lg overflow-hidden shadow-sm border border-gray-100">
                                    <img src="{{ $service->image_url }}" alt="" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $service->title }}</td>
                            <td class="px-6 py-4 text-gray-600 font-medium">
                                {{ $service->dept }}
                                <span class="block mt-1 text-[10px] font-bold {{ $service->group === 'home' ? 'text-blue-600' : 'text-gray-400' }}">
                                    {{ $service->group === 'home' ? 'الصفحة الرئيسية' : 'صفحة الخدمات' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-semibold">{{ $service->order }}</td>
                            <td class="px-6 py-4 text-xs font-bold text-gray-600">
                                {{ is_array($service->features) ? count($service->features) : 0 }} ميزات مضافة
                            </td>
                            <td class="px-6 py-4">
                                @if ($service->is_active)
                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">نشط</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-50 px-2.5 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">معطل</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذه الخدمة نهائياً؟')">
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
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-bold">لا يوجد أي خدمات مضافة حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
