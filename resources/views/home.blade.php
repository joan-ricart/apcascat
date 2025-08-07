@extends('layouts.default')

@section('title', 'Inici')

@section('content')
    <main class="container py-12">
        <div class="container">
            @if ($posts)
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($posts as $post)
                        <x-posts.card :$post></x-posts.card>
                    @endforeach
                </div>
            @endif
        </div>

        @forelse ($categories as $category)
            <div>
                {{ $category->name }}
            </div>
        @empty
            <div>No categories found</div>
        @endforelse
    </main>
@endsection
