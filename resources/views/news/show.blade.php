@extends('layouts.app')

@section('title', $article->title . ' | ' . __('ui.company.name'))
@section('description', $article->excerpt)

@section('content')

    {{-- ===== PAGE HEADER ===== --}}
    @include('partials.page-header', [
        'current' => $article->title,
        'eyebrow' => $article->category->name,
        'title'   => $article->title,
        'desc'    => $article->excerpt,
    ])

    <section class="py-20 bg-white">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <div class="reveal space-y-8 text-start">
                {{-- Date and Category --}}
                <div class="flex items-center gap-4 text-sm text-gray-500 justify-start">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        {{ $article->published_at ? $article->published_at->translatedFormat('j F Y') : '' }}
                    </span>
                    <span class="px-3.5 py-1 bg-brand-light text-brand text-xs font-bold rounded-full">
                        {{ $article->category->name }}
                    </span>
                </div>

                {{-- Featured Image --}}
                @if ($article->image)
                    <div class="rounded-3xl overflow-hidden shadow-lg aspect-video max-h-[480px] w-full">
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                {{-- Article Body --}}
                <div class="prose prose-lg max-w-none text-gray-700 leading-loose text-base sm:text-lg space-y-6">
                    @foreach (explode("\n\n", $article->body) as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>

                {{-- Back button --}}
                <div class="pt-8 border-t border-gray-100 flex flex-wrap gap-4 justify-between items-center">
                    <a href="{{ route('news') }}" class="inline-flex items-center gap-2 border-2 border-gray-900 hover:bg-gray-900 hover:text-white text-gray-900 px-6 py-2.5 rounded-xl font-bold transition-all text-sm">
                        <svg class="w-4 h-4 @if(app()->getLocale() === 'en') rotate-180 @endif" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                        {{ __('news_show.back_to_news') }}
                    </a>

                    <a href="{{ url('/contact') }}?subject={{ urlencode(__('news_show.contact_subject_prefix') . $article->title) }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white px-6 py-2.5 rounded-xl font-bold transition-all text-sm">
                        {{ __('news_show.contact_cta') }}
                        <svg class="w-4 h-4 @if(app()->getLocale() === 'en') rotate-180 @endif" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
