@extends('layouts.app')

@section('title', $project->title.' | '.__('projects.meta_title'))
@section('description', $project->summary ?: __('projects.meta_description'))
@section('og_image', $project->image_url)

@section('content')
    <section class="relative min-h-[560px] flex items-end overflow-hidden bg-[#141414] text-white">
        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/65 to-black/20"></div>
        <div class="relative mx-auto w-full max-w-7xl px-4 sm:px-6 pb-14 pt-40">
            <nav class="mb-8 flex flex-wrap items-center gap-2 text-sm text-white/70" aria-label="{{ __('projects.breadcrumb') }}">
                <a href="{{ route('projects') }}" class="hover:text-white transition-colors">{{ __('projects.back_to_projects') }}</a>
                <span aria-hidden="true">/</span>
                <span class="text-white">{{ $project->title }}</span>
            </nav>
            <span class="inline-flex rounded-full bg-brand px-4 py-2 text-xs font-black shadow-lg">{{ $project->category->name }}</span>
            <h1 class="mt-5 max-w-4xl text-3xl sm:text-5xl lg:text-6xl font-black leading-tight">{{ $project->title }}</h1>
            @if ($project->summary)
                <p class="mt-5 max-w-3xl text-base sm:text-lg leading-8 text-white/80">{{ $project->summary }}</p>
            @endif
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            @php
                $facts = [
                    [__('projects.client_label'), $project->client],
                    [__('projects.location_label'), $project->location],
                    [__('projects.year_label'), $project->year],
                    [__('projects.status_label'), $project->status],
                    [__('projects.duration_label'), $project->duration],
                ];
                $facts = array_filter($facts, fn ($fact) => filled($fact[1]));
            @endphp

            @if ($facts)
                <dl class="grid grid-cols-2 lg:grid-cols-5 gap-px overflow-hidden rounded-2xl bg-gray-200 ring-1 ring-gray-200 shadow-sm mb-16">
                    @foreach ($facts as [$label, $value])
                        <div class="bg-[#f8f8f8] px-5 py-6">
                            <dt class="text-xs font-bold text-gray-500">{{ $label }}</dt>
                            <dd class="mt-2 text-base font-black text-[#141414]">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            @endif

            @if ($project->description)
                <div class="grid lg:grid-cols-[280px_1fr] gap-8 lg:gap-16 mb-16">
                    <h2 class="text-2xl sm:text-3xl font-black text-[#141414]">{{ __('projects.overview_label') }}</h2>
                    <div class="whitespace-pre-line text-base sm:text-lg leading-9 text-[#4b4b4b]">{{ $project->description }}</div>
                </div>
            @endif

            @php
                $sections = [
                    [__('projects.challenge_label'), $project->challenge],
                    [__('projects.solution_label'), $project->solution],
                    [__('projects.scope_label'), $project->scope],
                    [__('projects.equipment_label'), $project->equipment],
                    [__('projects.results_label'), $project->results],
                ];
                $sections = array_values(array_filter($sections, fn ($section) => filled($section[1])));
            @endphp

            @if ($sections)
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach ($sections as $index => [$heading, $body])
                        <article class="rounded-2xl border border-gray-100 bg-[#f8f8f8] p-7 sm:p-8 {{ count($sections) % 2 === 1 && $index === count($sections) - 1 ? 'md:col-span-2' : '' }}">
                            <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-brand text-sm font-black text-white">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <h2 class="text-xl font-black text-[#141414]">{{ $heading }}</h2>
                            <div class="mt-4 whitespace-pre-line leading-8 text-[#4b4b4b]">{{ $body }}</div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @if ($project->images->isNotEmpty())
        <section class="bg-[#f5f5f5] py-16 sm:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6">
                <div class="mb-9 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                    <div>
                        <span class="text-xs font-black uppercase tracking-widest text-brand">{{ __('projects.gallery_eyebrow') }}</span>
                        <h2 class="mt-2 text-2xl sm:text-3xl font-black text-[#141414]">{{ __('projects.gallery_title') }}</h2>
                    </div>
                    <p class="text-sm text-gray-500">{{ __('projects.gallery_hint') }}</p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ($project->images as $index => $galleryImage)
                        <button type="button" class="gallery-item group relative overflow-hidden rounded-2xl bg-black text-start shadow-sm aspect-[4/3]" data-index="{{ $index }}" data-src="{{ $galleryImage->image_url }}" data-caption="{{ $galleryImage->caption }}">
                            <img src="{{ $galleryImage->image_url }}" alt="{{ $galleryImage->caption ?: $project->title }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105 group-focus:scale-105">
                            <span class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></span>
                            @if ($galleryImage->caption)
                                <span class="absolute inset-x-0 bottom-0 p-5 text-sm font-bold leading-6 text-white">{{ $galleryImage->caption }}</span>
                            @endif
                            <span class="absolute top-4 end-4 grid h-10 w-10 place-items-center rounded-full bg-black/55 text-white backdrop-blur-sm" aria-hidden="true">+</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        <div id="projectLightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/95 p-4 sm:p-8" role="dialog" aria-modal="true" aria-label="{{ __('projects.gallery_title') }}">
            <button type="button" id="lightboxClose" class="absolute top-5 end-5 rounded-full bg-white/10 px-4 py-2 text-sm font-bold text-white hover:bg-white/20">{{ __('projects.close') }}</button>
            <button type="button" id="lightboxPrev" class="absolute start-4 sm:start-8 rounded-full bg-white/10 p-4 text-2xl text-white hover:bg-white/20" aria-label="{{ __('projects.previous_image') }}">‹</button>
            <figure class="max-w-6xl">
                <img id="lightboxImage" src="" alt="" class="max-h-[78vh] max-w-full rounded-xl object-contain">
                <figcaption id="lightboxCaption" class="mx-auto mt-4 max-w-3xl text-center text-sm leading-6 text-white/80"></figcaption>
            </figure>
            <button type="button" id="lightboxNext" class="absolute end-4 sm:end-8 rounded-full bg-white/10 p-4 text-2xl text-white hover:bg-white/20" aria-label="{{ __('projects.next_image') }}">›</button>
        </div>
    @endif
@endsection

@push('scripts')
@if ($project->images->isNotEmpty())
<script>
    (() => {
        const items = [...document.querySelectorAll('.gallery-item')];
        const lightbox = document.getElementById('projectLightbox');
        const image = document.getElementById('lightboxImage');
        const caption = document.getElementById('lightboxCaption');
        let current = 0;

        function show(index) {
            current = (index + items.length) % items.length;
            const item = items[current];
            image.src = item.dataset.src;
            image.alt = item.dataset.caption || @json($project->title);
            caption.textContent = item.dataset.caption || '';
            caption.hidden = !item.dataset.caption;
        }

        function open(index) {
            show(index);
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
            document.getElementById('lightboxClose').focus();
        }

        function close() {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
            items[current].focus();
        }

        items.forEach((item, index) => item.addEventListener('click', () => open(index)));
        document.getElementById('lightboxClose').addEventListener('click', close);
        document.getElementById('lightboxPrev').addEventListener('click', () => show(current - 1));
        document.getElementById('lightboxNext').addEventListener('click', () => show(current + 1));
        lightbox.addEventListener('click', event => { if (event.target === lightbox) close(); });
        document.addEventListener('keydown', event => {
            if (lightbox.classList.contains('hidden')) return;
            if (event.key === 'Escape') close();
            if (event.key === 'ArrowLeft') show(current - 1);
            if (event.key === 'ArrowRight') show(current + 1);
        });
    })();
</script>
@endif
@endpush
