@extends('layouts.sidebar')

@section('title', __('Asociados'))

@section('content')
<x-breadcrumb :items="[
    ['url' => route('associates.index'), 'title' => __('Pèrits')],
    ['title' => $associate->first_name . ' ' . $associate->last_name]
]" />

<section class="flex justify-center md:py-12">
    <div class="w-full rounded-xl border shadow-lg max-w-4xl">
        <header class="flex items-center gap-4 border-b p-6 py-8">
            @if ($associate->photo)
                <img src="data:image/jpeg;base64,{{ $associate->photo }}"
                    alt="Imagen de {{ $associate->first_name }}" class="size-20 rounded-full object-cover">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                    stroke="currentColor" class="text-brand size-20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            @endif
            <div>
                <h1 class="text-xl font-bold">{{ $associate->first_name }} {{ $associate->last_name }}</h1>
                <p class="text-stone-500">{{ str_replace('_', ' ', $associate->category) }}</p>
            </div>
        </header>
        <div class="p-6 py-12 grid sm:grid-cols-2 lg:grid-cols-3 items-between gap-8">
            <div class="sm:col-span-2 lg:col-span-1">
                <h2 class="mb-2 font-bold">Dades de contacte</h2>
                <ul class="space-y-2">
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-brand size-5 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span class="uppercase">
                            {{ $associate->city ? $associate->city.',' : '' }} {{ $associate->province }}
                        </span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-brand size-5 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                        <a href="tel:{{ $associate->phone }}" target="_blank"
                            class="hover:underline">{{ $associate->phone }}</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="text-brand size-5 shrink-0">
                            <path fill-rule="evenodd"
                                d="M17.834 6.166a8.25 8.25 0 1 0 0 11.668.75.75 0 0 1 1.06 1.06c-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788 3.807-3.808 9.98-3.808 13.788 0A9.722 9.722 0 0 1 21.75 12c0 .975-.296 1.887-.809 2.571-.514.685-1.28 1.179-2.191 1.179-.904 0-1.666-.487-2.18-1.164a5.25 5.25 0 1 1-.82-6.26V8.25a.75.75 0 0 1 1.5 0V12c0 .682.208 1.27.509 1.671.3.401.659.579.991.579.332 0 .69-.178.991-.579.3-.4.509-.99.509-1.671a8.222 8.222 0 0 0-2.416-5.834ZM15.75 12a3.75 3.75 0 1 0-7.5 0 3.75 3.75 0 0 0 7.5 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="mailto:{{ $associate->email }}" target="_blank"
                            class="hover:underline">{{ $associate->email }}</a>
                    </li>
                </ul>
            </div>
            <div class="">
                <h2 class="mb-2 font-bold">{{__('Especialitat')}}</h2>
                <ul class="space-y-2">
                    @foreach ($associate->specialties as $specialty)
                        <li>{{ $specialty['nombre'] }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="">
                <h2 class="mb-2 font-bold">{{__('Acreditació')}}</h2>
                <ul class="space-y-2">
                    @foreach ($associate->specialties as $specialty)
                        <li>{{ $specialty['acreditacion'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</section>
@endsection

@section('sidebar')
<div class="space-y-6">
    <x-sidebar.recent-posts />
    <x-sidebar.categories />
</div>
@endsection