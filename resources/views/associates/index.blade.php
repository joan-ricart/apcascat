@extends('layouts.sidebar')

@section('title', __("Directori de pèrits APCAS Catalunya"))

@section('content')
    <x-breadcrumb :items="[['title' => __('Directori de pèrits APCAS Catalunya')]]" />

    <header class="mb-6">
        <h1 class="mb-1 text-3xl font-bold">{{__("Directori de pèrits APCAS Catalunya")}}</h1>
    </header>

    <section class="mb-6 rounded-lg bg-gray-100 p-4">
        <form action="{{ route('associates.index') }}" method="GET" class="flex items-end space-x-4">
            <div>
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
            <div>
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
            <button type="submit"
                class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm">{{ __('Cercar') }}</button>
            @if ($province || $specialty)
                <a href="{{ route('associates.index') }}"
                    class="inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-sm font-medium text-white shadow-sm">{{ __('Esborrar filtres') }}</a>
            @endif
        </form>
    </section>

    <section>
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
                @foreach ($associates as $associate)
                    <tr onclick="window.location='{{ route('associates.show', $associate) }}'">
                        <td class="border-b p-2">{{ $associate->first_name }}</td>
                        <td class="border-b p-2">{{ $associate->last_name }}</td>
                        <td class="border-b p-2">{{ $associate->city }}</td>
                        <td class="border-b p-2">{{ $associate->email }}</td>
                        <td class="border-b p-2">{{ $associate->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection

@section('sidebar')
    <div class="space-y-6">
        <x-sidebar.recent-posts />
        <x-sidebar.categories />
    </div>
@endsection
