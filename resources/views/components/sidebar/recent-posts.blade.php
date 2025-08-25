<div class="">
    <div class="mb-4 flex items-center gap-2 font-bold">
        <span class="text-brand">▪</span>
        {{ __('Más noticias recientes') }}
    </div>
    <nav class="grid gap-y-4">
        @foreach ($posts as $post)
            <div class="grid grid-cols-12 items-start gap-3" onclick="window.location='{{ route('posts.show', $post) }}'">

                <img class="col-span-4" src="{{ $post->getImages()->first() }}"
                    class="aspect-square max-w-full object-cover object-top" />

                <div class="col-span-8">
                    <div class="line-clamp-2 text-sm">{{ $post->title }}</div>
                    <div class="flex items-center gap-2">
                        <div class="shrink-0">
                            <x-formatted-date class="text-sm" :date="$post->formattedDate" />
                        </div>
                        <div>•</div>
                        <div class="shrink grow-0">
                            <x-post-categories class="text-sm" :categories="$post->categories->take(1)" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </nav>
</div>
