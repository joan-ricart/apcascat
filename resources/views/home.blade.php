@extends('layouts.default')

@section('title', 'Inici')

@section('content')

    @php
        $settings = \App\Models\Setting::first();
    @endphp

    @if ($settings->display_home_video && $settings->home_video_url)
        <div class="bg-stone-900 py-4 md:py-10">
            <div class="container aspect-video">
                <iframe class="h-full w-full" src="{{ $settings->home_video_url }}" title="Home Video" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    @endif

    <section class="container py-12">
        <div class="mb-6 flex flex-wrap justify-between gap-4 md:flex-nowrap md:items-center">
            <h2 class="text-2xl font-bold lg:text-3xl">{{ __('Últimes notícies APCAS') }}</h2>
            <a href="{{ route('posts.index') }}"
                class="bg-brand rounded-lg px-3 py-1.5 text-sm font-semibold text-white shadow transition-all hover:-translate-y-[1px] hover:shadow-md sm:text-base">
                {{ __('Ver todas las noticias') }}
            </a>
        </div>
        <x-posts.list :posts="$posts" />
    </section>
@endsection
