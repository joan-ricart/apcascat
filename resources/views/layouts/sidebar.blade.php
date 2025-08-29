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
    <div class="container grid gap-10 py-12 md:grid-cols-12">
        <main class="md:col-span-9">
            @yield('content')
        </main>
        <aside class="md:col-span-3">
            @yield('sidebar')
        </aside>
    </div>
    @include('partials.footer')
    @stack('scripts')
</body>

</html>
