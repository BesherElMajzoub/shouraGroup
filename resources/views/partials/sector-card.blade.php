{{--
    بطاقة قطاع في الشبكة الدائرية بالصفحة الرئيسية.
    المتغيرات: $s (Sector) · $i (الفهرس للتأخير) · $align ('right' | 'left')
--}}
@php $isRight = ($align ?? 'right') === 'right'; @endphp

<a href="{{ $s->is_coming_soon ? 'javascript:void(0)' : route('sectors.show', $s->slug) }}"
   @if ($s->is_coming_soon) aria-disabled="true" tabindex="-1" @endif
   class="reveal group flex items-center gap-4 bg-white rounded-2xl shadow-md ring-1 ring-black/5 p-5
          transition-all {{ $s->is_coming_soon ? 'opacity-60 cursor-default' : 'hover:shadow-xl hover:-translate-y-0.5' }}"
   style="transition-delay:{{ $i * 0.06 }}s">

    @unless ($isRight)
        <span class="shrink-0 w-12 h-12 rounded-xl bg-brand-light text-brand grid place-items-center
                     group-hover:bg-brand group-hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $s->icon }}"/></svg>
        </span>
    @endunless

    <div class="flex-1 text-start">
        <p class="text-[15px] font-bold text-[#141414] leading-snug">
            {{ $s->name }}
            @if ($s->is_coming_soon)
                <span class="mr-1 text-[11px] font-bold text-brand bg-brand-light rounded-full px-2 py-0.5">{{ __('ui.common.coming_soon') }}</span>
            @endif
        </p>
        @if ($s->tagline && ! $s->is_coming_soon)
            <p class="text-xs text-[#9a9a9a] mt-1 leading-relaxed">{{ $s->tagline }}</p>
        @endif
    </div>

    @if ($isRight)
        <span class="shrink-0 w-12 h-12 rounded-xl bg-brand-light text-brand grid place-items-center
                     group-hover:bg-brand group-hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $s->icon }}"/></svg>
        </span>
    @endif
</a>
