@extends('layouts.sidebar')

@section('title', __('Noticias'))

@section('content')

    <x-breadcrumb :items="[
        ['url' => route('posts.index'), 'title' => __('Noticias')],
        ['title' => $post->title]
    ]" />

    <header class="mb-4">
        <h1 class="mb-3 text-3xl font-bold">{!! $post->title !!}</h1>
        <div class="flex items-center justify-start gap-2">
            <x-formatted-date :date="$post->formattedDate" />
            <div class="text-gray-300">•</div>
            <x-post-categories :categories="$post->categories->take(1)" />
        </div>
    </header>

    <div class="no-tailwind-reset prose mb-4">
        {!! $post->intro !!}
    </div>

    <img src="{{ $post->getImages()->first() }}" class="mb-4 w-full" />

    <div class="no-tailwind-reset prose mb-4">
        {!! $post->body !!}
    </div>

    @if ($post->getFiles()->isNotEmpty())
        <div class="mb-8 rounded-lg border bg-stone-50 p-6 shadow">
            <div class="mb-3 font-bold">{{ __('Documentación adjunta') }}</div>
            @foreach ($post->getFiles() as $k => $file)
                <div>
                    <a href="{{ $file }}" target="_blank" class="flex items-center gap-2 py-0.5 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                        </svg>
                        <span>Document {{ $k + 1 }}</span>
                    </a>
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
    <div class="space-y-6">
        <x-sidebar.recent-posts />
        <x-sidebar.categories />
    </div>
@endsection
