<header x-data="{ open: false }" class="sticky top-0 z-50 flex h-16 items-center bg-black shadow-md">
    <div class="container flex items-center justify-between">
        <div>
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo-apcas.png') }}"
                    alt="APCAS Catalunya - Asociación de Peritos de Seguros y Comisarios de Averías" width="249"
                    height="54" class="w-48" />
            </a>
        </div>
        <nav class="items-center gap-8 text-white md:flex">
            <a href="{{ route('posts.index') }}" class="px-3 hover:underline">{{ __('Noticias') }}</a>
            <a href="{{ route('associates.index') }}" class="px-3 hover:underline">{{ __('Encuentra un perito') }}</a>
        </nav>
        {{-- <div class="md:hidden">
            <button @click="open = !open" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div> --}}
    </div>
    {{-- <div x-show="open" @click.away="open = false" class="absolute top-16 left-0 w-full bg-black text-white md:hidden">
        <nav class="flex flex-col items-center gap-4 py-4">
            <a href="{{ route('posts.index') }}">{{ __('Noticias') }}</a>
            <a href="{{ route('associates.index') }}">{{ __('Encuentra un perito') }}</a>
        </nav>
    </div> --}}
</header>
