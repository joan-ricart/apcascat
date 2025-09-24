<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('menu', {
        open: false
    })

    Alpine.effect(() => {
        if (Alpine.store('menu').open) {
            document.body.style.overflow = 'hidden'
        } else {
            document.body.style.overflow = ''
        }
    })
})
</script>

<header x-data class="sticky top-0 z-20 flex h-20 items-center shadow-md bg-center bg-cover" style="background-image: url('{{ asset("images/bg-header.jpg") }}')">
    <div class="container flex items-center justify-between">
        <div>
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo-apcas.png') }}"
                    alt="APCAS Catalunya - Asociación de Peritos de Seguros y Comisarios de Averías" width="208"
                    height="45" class="w-52" />
            </a>
        </div>
        <nav class="hidden items-center gap-1 text-white md:flex font-bold">
            <a href="{{ route('posts.index') }}" class="px-3 hover:underline">{{ __('Noticias') }}</a>
            <a href="{{ route('associates.index') }}" class="px-3 hover:underline">{{ __('Encuentra un perito') }}</a>
            <a href="https://apcas.es" target="blank" class="px-3 hover:underline">APCAS Nacional</a>
        </nav>
        <div class="md:hidden">
            <button @click="$store.menu.open = !$store.menu.open" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>
</header>

<div x-data x-cloak class="z-10 fixed top-20 bottom-0 right-0 left-0 w-full border-b bg-gray-200 shadow-md text-black py-4 transition-transform md:hidden" :class="!$store.menu.open && 'translate-x-[100%]'">
    <nav class="container text-lg text-right font-bold">
        <a href="{{ route('posts.index') }}" class="py-1 block border-b">{{ __('Noticias') }}</a>
        <a href="{{ route('associates.index') }}" class="py-1 bloc border-b">{{ __('Encuentra un perito') }}</a>
        <a href="https://apcas.es" target="blank" class="py-1 block border-b">APCAS Nacional</a>
    </nav>
</div>
