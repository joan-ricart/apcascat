@props(['post'])

<div>
    <h2 class="text-lg font-bold">{{ $post->title }}</h2>
    <p>{{ $post->intro }}</p>
</div>
