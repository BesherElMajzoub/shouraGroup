@extends('layouts.admin')

@section('title', 'تفاصيل طلب جملة')
@section('page_title', 'تفاصيل طلب مبيعات الجملة')

@section('admin_content')

    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('admin.wholesale.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            <span>الرجوع للقائمة</span>
        </a>

        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 overflow-hidden text-right">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between gap-4">
                <div>
                    <h3 class="font-black text-gray-900 text-lg">{{ $request->name }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $request->created_at->translatedFormat('j F Y — H:i') }}</p>
                </div>
                <a href="tel:{{ preg_replace('/\s/', '', $request->phone) }}"
                   class="shrink-0 bg-brand hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-brand/20 transition-all">
                    اتصل بالعميل
                </a>
            </div>

            <dl class="divide-y divide-gray-100 text-sm">
                @foreach ([
                    ['رقم الهاتف', $request->phone, true],
                    ['المنتجات المهتم بها', $request->product_interest, false],
                    ['المحافظة', $request->governorate, false],
                    ['عنوان المحل / المنطقة', $request->address, false],
                ] as [$label, $value, $ltr])
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-xs font-bold text-gray-500">{{ $label }}</dt>
                        <dd class="col-span-2 text-gray-900 font-medium" @if ($ltr) dir="ltr" @endif>{{ $value }}</dd>
                    </div>
                @endforeach

                <div class="px-6 py-4">
                    <dt class="text-xs font-bold text-gray-500 mb-2">تفاصيل الطلبية</dt>
                    <dd class="text-gray-900 leading-loose whitespace-pre-line bg-gray-50 rounded-xl p-4">{{ $request->message ?: 'لا يوجد' }}</dd>
                </div>
            </dl>

            <div class="p-6 border-t border-gray-100 flex items-center gap-3">
                <form action="{{ route('admin.wholesale.destroy', $request->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا الطلب نهائياً؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-brand rounded-xl px-5 py-2.5 text-sm font-bold transition-all">
                        حذف الطلب
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
