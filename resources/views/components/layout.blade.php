<!DOCTYPE html>
<html lang="nl-BE">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ isset($title) ? $title . ' - Stock Market Rally' : 'Stock Market Rally' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,-25&icon_names=add,chevron_left,crown,info,more_vert">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="grid grid-rows-[auto_1fr_auto] min-h-screen bg-zinc-100">
        <header class="relative bg-stone-50 border-b border-black/20 py-6 px-8">
            <nav class="flex justify-between items-center">
                <ul class="flex gap-4 items-center">
                    <x-nav-link href="/"><img src="{{ Vite::asset('resources/images/logo.webp') }}" alt="Stock Market Rally Logo" class="h-9 object-contain pr-2"></x-nav-link>
                    <x-nav-link href="/portfolio" :active="request()->is('portfolio')" class="hidden md:block">Portefeuille</x-nav-link>
                    <x-nav-link href="/equities" :active="request()->is('equities')" class="hidden md:block">Aandelen</x-nav-link>
                    <x-nav-link href="/ranking" :active="request()->is('ranking')" class="hidden md:block">Ranglijst</x-nav-link>
                </ul>
                @guest
                    <ul class="flex gap-4 items-center">
                        <x-nav-link href="/login" :active="request()->is('login')" class="hidden md:block">Aanmelden</x-nav-link>
                        <x-nav-link href="/register" :active="request()->is('register')" class="hidden md:block">Registreren</x-nav-link>
                    </ul>
                @else
                <div class="flex gap-4 items-center">
                    <button form="logout-form" class="text-black/50 hover:text-black/70 cursor-pointer hidden md:block">Afmelden</button>
                </div>
                <form action="/logout" method="POST" id="logout-form" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
                @endguest
                <button popovertarget="mobile-menu" class="flex md:hidden! rounded border text-black/50 hover:text-black/70 border-black/20 shadow px-1.5 py-1 cursor-pointer">
                    Menu
                    <span class="material-symbols-outlined border-l border-black/20 ml-2">more_vert</span>
                </button>
                <div id="mobile-menu" popover class="md:hidden bg-stone-50 border border-black/20 rounded-lg shadow-lg p-4 m-4 top-14 ml-auto">
                    <ul class="border-b text-black/20 pb-4 mb-4">
                        <x-nav-link-mobile href="/portfolio" :active="request()->is('portfolio')">Portefeuille</x-nav-link>
                        <x-nav-link-mobile href="/equities" :active="request()->is('equities')">Aandelen</x-nav-link>
                        <x-nav-link-mobile href="/ranking" :active="request()->is('ranking')">Ranglijst</x-nav-link>
                    </ul>
                    @guest
                        <ul>
                            <x-nav-link-mobile href="/login" :active="request()->is('login')">Aanmelden</x-nav-link>
                            <x-nav-link-mobile href="/register" :active="request()->is('register')">Registreren</x-nav-link>
                        </ul>
                    @else
                        <button form="logout-form" class="w-full px-4 text-black/50 hover:text-black/70 cursor-pointer">Afmelden</button>
                    @endguest
                </div>
            </nav>
            @if (session('status') || session('error'))
                <span class="absolute left-1/2 -translate-x-1/2 top-17 text-white border border-black/10 rounded px-2 {{ session('status') ? 'bg-notice' : 'bg-error' }} py-1">{{ session('status') ?? session('error') }}</span>
            @endif
        </header>
        <main class="md:px-8">
            {{ $slot }}
        </main>
        <footer class="text-sm text-center pb-2 pt-6">
            <span class="text-black/40 font-bold py-1">Cornelis Peter {{ now()->year }}</span>
        </footer>
    </body>
</html>