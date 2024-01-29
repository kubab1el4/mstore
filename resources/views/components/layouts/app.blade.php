<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />

        {{-- Sortable.js --}}
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.1/Sortable.min.js"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/robsontenorio/mary@0.44.2/libs/currency/currency.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <style type="text/css">
            .parent > div:nth-of-type(2){
                height: 100%;
            }
        </style>
</head>

<body class="overflow-hidden min-h-screen font-sans antialiased">

{{-- The navbar with `sticky` and `full-width` --}}
<x-nav sticky full-width>

    <x-slot:brand>
        {{-- Drawer toggle for "main-drawer" --}}
        <label for="main-drawer" class="mr-3">
            <x-icon name="o-bars-3" class="cursor-pointer" />
        </label>

        {{-- Your logo --}}
        My App
    </x-slot:brand>

    {{-- Right side actions --}}
    <x-slot:actions>
        <x-dropdown>
            <x-slot:trigger>
                <x-button icon="o-user" class="btn-circle btn-outline" />
            </x-slot:trigger>

            @if(!Auth::check())
            <x-menu-item href="login" title="Zaloguj" />
            <x-menu-item href="register" title="Zarejestruj" />
            @else
            <x-menu-item href="profile" title="Konto" />
            @endif
            @if(Auth::check() && auth()->user()->role == 'ADMIN')
            <x-menu-item href="admin" title="Panel administratora" />
            @endif
        </x-dropdown>
        <label for="cart" class="mr-3">
            <x-icon name="o-shopping-cart" class="btn-circle btn-outline cursor-pointer"/>
        </label>
    </x-slot:actions>
</x-nav>

{{-- The main content with `full-width` --}}
<x-main with-nav full-width>

    {{-- This is a sidebar that works also as a drawer on small screens --}}

    {{-- The `$slot` goes here --}}
    <x-slot:content>
        {{ $slot }}
    </x-slot:content>

    {{-- Footer area --}}
    <x-slot:footer>
        <hr />
        <div class="overflow-hidden absolute inset-x-0 bottom-0 p-6">
            Footer
        </div>
    </x-slot:footer>
</x-main>
<x-drawer full-width id="main-drawer" title="Options" left separator with-close-button class="lg:w-1/3">

        <x-menu activate-by-route>
            <x-menu-item title="Sklep" icon="o-home" link="/" />
        </x-menu>
</x-drawer>
<x-drawer full-width id="cart" title="Cart" right separator with-close-button class="parent overflow-y-clip w-1/3 h-screen">
    <div class="min-h-full flex flex-col justify-between">
    <livewire:item-list></livewire:item-list>
    <livewire:checkout-button></livewire:checkout-button>
    </div>
</x-drawer>
@livewireScriptConfig
</body>
</html>
