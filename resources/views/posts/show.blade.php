@extends('layouts.sidebar')

@section('title', __('Noticias'))

@section('content')

    <div class="mb-4 text-sm text-black">
        <a href="{{ route('home') }}" class="hover:underline">{{ __('Inici') }}</a>
        <span class="text-gray-700">//</span>
        <a href="{{ route('posts.index') }}" class="hover:underline">{{ __('Noticias') }}</a>
    </div>

    <header class="mb-6">
        <h1 class="mb-3 text-3xl font-bold">{!! $post->title !!}</h1>
        <div class="flex items-center justify-start gap-2">
            <x-formatted-date :date="$post->formattedDate" />
            <div class="text-gray-300">•</div>
            <x-post-categories :categories="$post->categories->take(1)" />
        </div>
    </header>

    <img src="{{ $post->getImages()->first() }}" class="mb-6 w-full" />

    <div class="no-tailwind-reset prose mb-8">
        {!! $post->intro !!}
        {!! $post->body !!}
    </div>

    @if ($post->getFiles()->isNotEmpty())
        <div class="mb-8 rounded-lg border bg-stone-50 p-6 shadow">
            <div class="mb-2 font-bold">{{ __('Documentación adjunta') }}</div>
            @foreach ($post->getFiles() as $k => $file)
                <div>
                    <a href="{{ $file }}" target="_blank" class="hover:underline">Document {{ $k + 1 }} -
                        {{ __('Descargar') }}</a>
                </div>
            @endforeach
        </div>
    @endif

    @if ($post->getImages()->isNotEmpty())
        <div class="space-y-4">
            @foreach ($post->getImages() as $k => $image)
                @if ($k > 0)
                    <img src="{{ $image }}" alt="Imagen {{ $k + 1 }} de {{ count($post->getImages()) }}"
                        class="w-full">
                @endif
            @endforeach
        </div>
    @endif

@endsection

@section('sidebar')
    <x-sidebar.categories />
    <x-sidebar.recent-posts />
@endsection
