<div>
    <div class="mb-3 flex items-center gap-2 font-bold">
        <span class="text-brand">▪</span>
        {{ __('Categories') }}
    </div>
    <nav class="space-y-1 text-sm">
        @foreach ($categories as $category)
            <div>
                <a href="{{ route('posts.categories.show', $category) }}" class="hover:underline">{{ $category->name }}
                    ({{ $category->posts_count }})
                </a>
            </div>
        @endforeach
    </nav>
</div>
