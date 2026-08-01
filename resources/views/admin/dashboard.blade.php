@extends('layouts.admin')

@section('title', 'الرئيسية')
@section('page_title', 'لوحة التحكم الرئيسية')

@section('admin_content')

    <!-- Metrics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- sectors count card -->
        <a href="{{ route('admin.sectors.index') }}" class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-black/5 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <span class="text-xs font-bold text-gray-500 block mb-1">قطاعات العمل</span>
                <span class="text-2xl font-black text-gray-900">{{ $sectorsCount }}</span>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl grid place-items-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25Z"/></svg>
            </div>
        </a>

        <!-- brands count card -->
        <a href="{{ route('admin.brands.index') }}" class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-black/5 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <span class="text-xs font-bold text-gray-500 block mb-1">العلامات التجارية</span>
                <span class="text-2xl font-black text-gray-900">{{ $brandsCount }}</span>
            </div>
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl grid place-items-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a1.44 1.44 0 0 0 2.037 0l4.318-4.318a1.44 1.44 0 0 0 0-2.037L11.159 3.659A2.25 2.25 0 0 0 9.568 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 7.5h.008v.008H6V7.5Z"/></svg>
            </div>
        </a>

        <!-- projects count card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-black/5 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-gray-500 block mb-1">المشاريع المنجزة</span>
                <span class="text-2xl font-black text-gray-900">{{ $projectsCount }}</span>
            </div>
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl grid place-items-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75"/></svg>
            </div>
        </div>

        <!-- news count card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-black/5 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-gray-500 block mb-1">الأخبار والمستجدات</span>
                <span class="text-2xl font-black text-gray-900">{{ $newsCount }}</span>
            </div>
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl grid place-items-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/></svg>
            </div>
        </div>

        <!-- unread messages count card -->
        <a href="{{ route('admin.messages.index') }}" class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-black/5 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <span class="text-xs font-bold text-gray-500 block mb-1">رسائل جديدة</span>
                <span class="text-2xl font-black text-brand">{{ $unreadMessagesCount }}</span>
            </div>
            <div class="w-12 h-12 bg-red-50 text-[#e11d26] rounded-xl grid place-items-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
            </div>
        </a>
    </div>

    <!-- Inbox shortcuts -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
        <a href="{{ route('admin.wholesale.index') }}" class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-black/5 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <span class="text-xs font-bold text-gray-500 block mb-1">طلبات مبيعات الجملة الجديدة</span>
                <span class="text-2xl font-black {{ $unreadWholesaleCount ? 'text-brand' : 'text-gray-900' }}">{{ $unreadWholesaleCount }}</span>
            </div>
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl grid place-items-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9l1.5-4.5A1 1 0 0 1 5.45 4h13.1a1 1 0 0 1 .95.5L21 9M3 9h18M3 9v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V9M9 13h6"/></svg>
            </div>
        </a>

        <a href="{{ route('admin.applications.index') }}" class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-black/5 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <span class="text-xs font-bold text-gray-500 block mb-1">طلبات التوظيف الجديدة</span>
                <span class="text-2xl font-black {{ $unreadApplicationsCount ? 'text-brand' : 'text-gray-900' }}">{{ $unreadApplicationsCount }}</span>
            </div>
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl grid place-items-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0M18 13.5v4.5m2.25-2.25h-4.5"/></svg>
            </div>
        </a>
    </div>

    <!-- Recent Messages Table -->
    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-black text-gray-900 text-base">آخر الرسائل الواردة</h3>
            <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-brand hover:underline">عرض كافة الرسائل</a>
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
                    @forelse ($recentMessages as $msg)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $msg->name }}</td>
                            <td class="px-6 py-4 text-gray-600" dir="ltr text-right">{{ $msg->phone }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $msg->department_name }}</td>
                            <td class="px-6 py-4 text-gray-900 font-medium">{{ $msg->subject }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $msg->created_at->translatedFormat('j M Y, H:i') }}</td>
                            <td class="px-6 py-4">
                                @if ($msg->is_read)
                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">مقروءة</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-brand ring-1 ring-inset ring-red-600/20">جديدة</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 text-xs font-bold transition-all">
                                    عرض التفاصيل
                                </a>
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
    </div>

@endsection
