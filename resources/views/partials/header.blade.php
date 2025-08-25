<header class="sticky top-0 z-50 flex h-16 items-center bg-black shadow-md">
    <div class="container flex items-center justify-between">
        <div>
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo-apcas.png') }}"
                    alt="APCAS Catalunya - Asociación de Peritos de Seguros y Comisarios de Averías" width="249"
                    height="54" class="w-48" />
            </a>
        </div>
        <nav class="text-white">
            <a href="{{ route('posts.index') }}">{{ __('Noticias') }}</a>
            <a href="#">{{ __('Encuentra un perito') }}</a>
        </nav>
    </div>
</header>
