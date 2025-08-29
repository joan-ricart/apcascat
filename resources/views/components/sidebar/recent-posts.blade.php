<div>
    <div class="mb-3 flex items-center gap-2 font-bold">
        <span class="text-brand">▪</span>
        {{ __('Actualitat APCAS Catalunya') }}
    </div>
    <nav class="grid gap-y-4">
        @foreach ($posts as $post)
            <div class="grid cursor-pointer grid-cols-12 items-start gap-3 transition-transform hover:scale-[1.01]"
                onclick="window.location='{{ route('posts.show', $post) }}'">

                <img class="col-span-5" src="{{ $post->getImages()->first() }}"
                    class="aspect-square max-w-full object-cover object-top" />

                <div class="col-span-7">
                    <div class="line-clamp-2 text-sm">{{ $post->title }}</div>
                    <div class="grid gap-0.5">
                        <x-formatted-date class="text-sm" :date="$post->formattedDate" />
                        <x-post-categories class="text-sm" :categories="$post->categories->take(1)" />
                    </div>
                </div>
            </div>
        @endforeach
    </nav>
</div>
