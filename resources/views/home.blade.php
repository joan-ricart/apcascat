@extends('layouts.default')

@section('title', 'Inici')

@section('content')
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
