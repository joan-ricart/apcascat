@props(['post'])

<div class="overflow-hidden rounded-md border shadow transition-transform hover:scale-[1.01] hover:shadow-md">
    <a href="{{ route('posts.show', $post) }}" class="block">
        @if ($post->getImages()->first())
            <img src="{{ $post->getImages()->first() }}" class="aspect-[4/3] w-full object-cover" />
        @else
            <div class="aspect-4/3 bg-brand/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="text-brand/50 size-10">
                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                    <circle cx="9" cy="9" r="2" />
                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                </svg>
            </div>
        @endif
    </a>
    <div onclick="window.location='{{ route('posts.show', $post) }}'" class="p-4">
        <div class="mb-2 flex items-center gap-2">
            <x-formatted-date class="shrink-0 text-sm" :date="$post->formattedDate" />
            <div class="text-xs text-stone-200">•</div>
            <x-post-categories class="shrink grow-0 text-sm" :categories="$post->categories->take(1)" />
        </div>

        <h2 class="mb-2 line-clamp-3 text-base font-semibold">{!! $post->title !!}</h2>
    </div>
</div>
