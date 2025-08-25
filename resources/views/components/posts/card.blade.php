@props(['post'])

<div class="overflow-hidden rounded-md border shadow">
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
            <div class="shrink-0">
                <x-formatted-date class="text-sm" :date="$post->formattedDate" />
            </div>
            <div>•</div>
            <div class="shrink grow-0">
                <x-post-categories class="text-sm" :categories="$post->categories->take(1)" />
            </div>
        </div>

        <h2 class="mb-2 line-clamp-3 text-base font-semibold">{!! $post->title !!}</h2>

        {{-- <div class="mb-4 line-clamp-2 text-sm font-normal">{!! $post->intro !!}</div> --}}

        {{-- <a href="{{ route('posts.show', $post) }}"
            class="bg-brand block rounded-md border px-4 py-2 text-center text-white shadow">{{ __('Ver noticia') }}</a> --}}
    </div>
</div>
