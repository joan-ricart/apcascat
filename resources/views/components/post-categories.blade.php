@props(['categories'])

@if ($categories->isNotEmpty())
    <div {{ $attributes->merge(['class' => 'inline-flex gap-2']) }}>
        @foreach ($categories as $category)
            <a href="{{ route('posts.categories.show', $category) }}"
                class="bg-brand rounded-full px-3 py-0.5 text-xs text-white shadow transition-all hover:-translate-y-[1px] hover:shadow-md">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
@endif
