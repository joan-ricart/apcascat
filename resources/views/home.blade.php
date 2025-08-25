@extends('layouts.default')

@section('title', 'Inici')

@section('content')
    <div class="container py-20">
        <section>
            <div class="mb-6 flex items-center justify-between gap-4">
                <h2 class="text-2xl font-bold">{{ __('Noticias más recientes') }}</h2>
                <a href="{{ route('posts.index') }}"
                    class="bg-brand rounded-lg px-2.5 py-1.5 text-sm text-white shadow shadow transition-all hover:-translate-y-[1px] hover:shadow-md hover:shadow-md">
                    {{ __('Ver todas las noticias') }}
                </a>
            </div>
            <div class="mb-10 grid items-stretch gap-4 lg:grid-cols-3">
                <x-posts.list :posts="$posts" />
            </div>
        </section>

    </div>


    <a href="https://apcas.es/asociate/" target="_blank" class="bg-brand block px-4 py-20 text-center text-xl text-white">
        {{ __('¿Eres perito profesional? ¡Asóciate!') }}
    </a>
@endsection
