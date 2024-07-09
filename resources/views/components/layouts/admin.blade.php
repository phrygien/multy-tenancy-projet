<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <div class="pt-5 ml-5">
                <img class="w-30 h-9 ml-2" src="{{ asset('images/login.png')}}" alt="Your Company">
                {{-- <span class="font-bold text-3xl mr-3 bg-gradient-to-r from-amber-500 to-amber-300 bg-clip-text text-transparent ">
                    Me-soft
                </span> --}}
            </div>
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="mr-3 lg:hidden">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit" full-width>

            {{-- BRAND --}}
            <div class="flex items-center gap-1">
                <img class="w-30 h-10 ml-2" src="{{ asset('images/login.png')}}" alt="Your Company">
                <span class="font-bold text-3xl mr-3 bg-gradient-to-r from-amber-500 to-amber-300 bg-clip-text text-transparent ">
                    Me-soft
                </span>
            </div>

            {{-- MENU --}}
            <x-menu title="{{ null }}" activate-by-route>

                @if(auth()->check())
                    <x-menu-separator />

                    {{-- User --}}
                    <livewire:admin.user-menu />

                    <x-menu-separator />
                @endif

                <x-menu-item title="Dashboard" icon="o-sparkles" link="/" />
                @if(Auth::user()->is_admin == 1)
                {{-- <x-menu-item title="Users" icon="o-user-group" link="{{ route('pages:users') }}" /> --}}
                {{-- <x-menu-sub title="Packs & Modules" icon="o-cpu-chip">
                    <x-menu-item title="Packs application" icon="o-archive-box" link="{{ route('pages:packs')}}" />
                    <x-menu-item title="Modules application" icon="o-archive-box" link="{{ route('pages:modules') }}" />
                </x-menu-sub> --}}
                @endif
                <x-menu-item title="Users" icon="o-user-group" link="{{ route('pages:users') }}" />
                <x-menu-item title="Tenant et Domain" icon="o-circle-stack" link="{{ route('pages:tenants')}}" />
                <x-menu-item title="Etablissements" icon="o-computer-desktop" link="{{ route('pages:schools') }}" />
                <x-menu-item title="Abonnements" icon="o-currency-euro" link="{{ route('pages:abonnements') }}" />
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content class="w-full mx-auto max-w-screen-2xl">
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast position="toast-top toast-right" />
</body>
</html>
