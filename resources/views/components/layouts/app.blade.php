<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
</head>
 
<body class="no-scrollbar min-h-screen font-sans antialiased">
 
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
        
            <x-menu-item href="login" title="Zaloguj" />
            <x-menu-item href="register" title="Zarejestruj" />
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
        <div class="absolute inset-x-0 bottom-0 p-6">
            Footer
        </div>
    </x-slot:footer>
</x-main>
<x-drawer full-width id="main-drawer" title="Options" left separator with-close-button class="lg:w-1/3">
 
        <x-menu activate-by-route>
            <x-menu-item title="Home" icon="o-home" link="###" />
            <x-menu-item title="Messages" icon="o-envelope" link="###" />
        </x-menu>
</x-drawer>
@php
    $session_id = Session::getId();
    $cart = \Cart::session($session_id);
    dd($cart);
@endphp
<x-drawer full-width id="cart" title="Cart" right separator with-close-button class="lg:w-1/5">
 
        <x-menu activate-by-route>
            <x-menu-item title="Home" icon="o-home" link="###" />
            <x-menu-item title="Messages" icon="o-envelope" link="###" />
        </x-menu>
</x-drawer>
@livewireScriptConfig
</body>
</html>
