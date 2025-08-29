@props(['posts'])

<div class="grid items-stretch gap-4 sm:grid-cols-2 xl:grid-cols-3">
    @foreach ($posts as $k => $post)
        <x-posts.card :$post></x-posts.card>
    @endforeach
</div>
