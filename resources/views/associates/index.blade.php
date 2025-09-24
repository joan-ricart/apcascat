@extends('layouts.default')

@section('title', __("Directori de pèrits APCAS Catalunya"))

@section('content')
<main class="container py-12">

    <x-breadcrumb :items="[['title' => __('Directori de pèrits APCAS Catalunya')]]" />

    <header class="mb-6">
        <h1 class="mb-1 text-3xl font-bold">{{__("Directori de pèrits APCAS Catalunya")}}</h1>
    </header>

    <section class="mb-6 rounded-lg bg-gray-100 p-4">
        <form action="{{ route('associates.index') }}" method="GET" class="grid sm:grid-cols-2 lg:grid-cols-4 items-end gap-4">
            <div class="w-full sm:w-auto">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Cercador') }}</label>
                <input type="text" name="name" id="name" value="{{ $name }}" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 pl-2 pr-12 text-base sm:text-sm" />
            </div>
            <div class="w-full sm:w-auto">
                <label for="province" class="block text-sm font-medium text-gray-700">{{ __('Provincia') }}</label>
                <select name="province" id="province"
                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 pl-2 pr-12 text-base sm:text-sm">
                    <option value="">{{ __('Totes') }}</option>
                    @foreach ($provinces as $p)
                        <option value="{{ $p }}" {{ $province == $p ? 'selected' : '' }}>
                            {{ $p }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full sm:w-auto">
                <label for="specialty" class="block text-sm font-medium text-gray-700">{{ __('Especialitat') }}</label>
                <select name="specialty" id="specialty"
                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 pl-2 pr-12 text-base sm:text-sm">
                    <option value="">{{ __('Totes') }}</option>
                    @foreach ($specialties as $s)
                        <option value="{{ $s }}" {{ $specialty == $s ? 'selected' : '' }}>
                            {{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit"
                class="lg:inline-flex items-center rounded-md border border-transparent bg-brand cursor-pointer px-4 py-2 text-white shadow-sm w-full sm:w-auto text-center">{{ __('Cercar') }}</button>
            </div>
        </form>
    </section>

    @if ($name || $province || $specialty)
    <div class="flex flex-wrap items-center gap-2 mb-6">
        @if ($name)
            <a href="{{ route('associates.index', request()->except('name')) }}" class="inline-flex items-center px-3 py-1 rounded-full bg-brand text-white text-sm">
                {{ $name }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        @endif
        @if ($province)
            <a href="{{ route('associates.index', request()->except('province')) }}" class="inline-flex items-center px-3 py-1 rounded-full bg-brand text-white text-sm">
                {{ __('Provincia') }}: {{ $province }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        @endif
        @if ($specialty)
            <a href="{{ route('associates.index', request()->except('specialty')) }}" class="inline-flex items-center px-3 py-1 rounded-full bg-brand text-white text-sm">
                {{ __('Especialitat') }}: {{ $specialty }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        @endif
        <a href="{{ route('associates.index') }}" class="underline hover:no-underline">{{ __('Restablir filtres') }}</a>
    </div>
    @endif

    <div class="mb-6">
        {{__('Mostrant') . ' ' . count($associates) . ' ' . __('pèrits')}}.
    </div>

    <section class="max-w-full overflow-x-auto hidden lg:block">
        <table class="w-full border">
            <thead class="text-white">
                <tr>
                    <td class="bg-brand p-2">{{ __('Nombre') }}</td>
                    <td class="bg-brand p-2">{{ __('Apellidos') }}</td>
                    <td class="bg-brand p-2">{{ __('Ciudad') }}</td>
                    <td class="bg-brand p-2">{{ __('Email') }}</td>
                    <td class="bg-brand p-2">{{ __('Teléfono') }}</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($associates as $associate)
                    <tr onclick="window.location='{{ route('associates.show', $associate) }}'" class="cursor-pointer hover:bg-gray-100">
                        <td class="border-b p-2">{{ $associate->first_name }}</td>
                        <td class="border-b p-2">{{ $associate->last_name }}</td>
                        <td class="border-b p-2">{{ $associate->city }}</td>
                        <td class="border-b p-2">{{ $associate->email }}</td>
                        <td class="border-b p-2">{{ $associate->phone }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center">{{ __('No s\'han trobat resultats') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:hidden">
        @forelse ($associates as $associate)
            <a href="{{ route('associates.show', $associate) }}" class="block border rounded-lg p-4 hover:bg-gray-100">
                <div class="flex items-center gap-4">
                    @if ($associate->photo)
                        <img src="data:image/jpeg;base64,{{ $associate->photo }}"
                            alt="Imagen de {{ $associate->first_name }}" class="size-16 rounded-full object-cover">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="text-brand size-16">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    @endif
                    <div>
                        <div class="font-bold">{{ $associate->first_name }} {{ $associate->last_name }}</div>
                        <div>{{ $associate->city }}</div>
                    </div>
                </div>
                <div class="mt-4">
                    <div>{{ $associate->email }}</div>
                    <div>{{ $associate->phone }}</div>
                </div>
            </a>
        @empty
            <div class="p-4 text-center sm:col-span-2">{{ __('No s\'han trobat resultats') }}</div>
        @endforelse
    </section>
</main>
@endsection

@section('sidebar')
    <div class="space-y-6">
        <x-sidebar.recent-posts />
        <x-sidebar.categories />
    </div>
@endsection
