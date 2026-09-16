@extends('layouts.admin')

@section('title', 'تعديل المشروع')
@section('page_title', 'تعديل المشروع')

@section('admin_content')
    <div class="max-w-6xl mx-auto space-y-6">
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <span>← الرجوع لقائمة المشاريع</span>
        </a>

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-7 text-right">
            @csrf
            @method('PUT')
            @include('admin.projects._form', ['submitLabel' => 'حفظ التغييرات'])
        </form>
    </div>
@endsection
