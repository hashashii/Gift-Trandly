@props(['gift', 'number'])

<article id="gift-{{ $gift->id }}" class="scroll-mt-28">
    <div class="relative overflow-hidden rounded-2xl">
        <img src="{{ $gift->image_url }}" alt="{{ $gift->title }}"
             class="aspect-[4/3] w-full object-cover" loading="lazy">
        <span class="absolute bottom-3 left-3 grid h-7 w-7 place-items-center rounded-full bg-blush-500 text-xs font-semibold text-white">
            {{ $number }}
        </span>
    </div>

    <h3 class="mt-3 text-[15px] font-semibold">{{ $gift->title }}</h3>

    @if ($gift->description)
        <p class="mt-1 text-sm leading-relaxed text-gray-600">{{ $gift->description }}</p>
    @endif

    @if ($gift->tags)
        <ul class="mt-2.5 flex flex-wrap gap-1.5">
            @foreach ($gift->tags as $tag)
                <li class="pill">{{ $tag }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ $gift->affiliate_url ?: '#' }}"
       @if ($gift->affiliate_url) target="_blank" rel="nofollow sponsored noopener" @endif
       class="btn-pink mt-3">
        {{ $gift->button_label }}
        @if ($gift->price)
            <span class="opacity-80">${{ number_format((float) $gift->price, 2) }}</span>
        @endif
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h13m-5-5 5 5-5 5"/>
        </svg>
    </a>
</article>
