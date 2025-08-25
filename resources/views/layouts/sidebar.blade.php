<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - APCAS Catalunya</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
    @include('partials.header')
    <div class="container grid gap-10 py-20 lg:grid-cols-12">
        <main class="col-span-8">
            @yield('content')
        </main>
        <aside class="col-span-4">
            @yield('sidebar')
        </aside>
    </div>
    @stack('scripts')
</body>

</html>
