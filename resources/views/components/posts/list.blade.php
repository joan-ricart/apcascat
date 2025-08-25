@props(['posts'])

@foreach ($posts as $k => $post)
    <x-posts.card :$post></x-posts.card>
@endforeach
