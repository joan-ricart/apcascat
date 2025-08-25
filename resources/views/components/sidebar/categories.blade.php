<div>
    <h3 class="text-lg font-semibold">Categories</h3>
    <ul>
        @foreach($categories as $category)
            <li>
                <a href="{{ route('posts.categories.show', $category) }}">{{ $category->name }} ({{ $category->posts_count }})</a>
            </li>
        @endforeach
    </ul>
</div>
