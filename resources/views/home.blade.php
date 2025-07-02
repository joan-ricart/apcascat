@extends('layouts.default')

@section('title', 'Inici')

@section('content')
    <main class="container py-12">
        @forelse ($posts as $post)
            <div>
                {{ $post->title }}
                <img src="{{ $post->getImages()->first() }}" />
            </div>
        @empty
            <div>No posts found</div>
        @endforelse

        @forelse ($categories as $category)
            <div>
                {{ $category->name }}
            </div>
        @empty
            <div>No categories found</div>
        @endforelse
    </main>
@endsection
