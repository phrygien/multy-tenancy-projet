<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
            <x-app-brand />
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
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            {{-- <x-app-brand class="p-5 pt-3" /> --}}
            <div class="flex items-center gap-1">
                <img class="w-30 h-15" src="{{ asset('images/login.png')}}" alt="Your Company">
                <span class="mr-3 text-3xl font-bold text-transparent bg-gradient-to-r from-amber-500 to-amber-300 bg-clip-text ">
                    {{ tenant('id') }}
                </span>
            </div>
            {{-- MENU --}}
            <x-menu title="{{ null }}" activate-by-route>

                @if(auth()->check())
                    <x-menu-separator />

                    <livewire:tenants.user-menu />

                    <x-menu-separator />
                @endif

                <x-menu-item title="Dashboard" icon="o-sparkles" link="/" />
                <x-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-menu-item title="Profile" icon="o-wifi" link="{{ route('pages:tenants:settings:profile') }}" />
                    <x-menu-item title="Tenant" icon="o-archive-box" link="####" />
                </x-menu-sub>
                {{-- <x-menu-item title="Store" icon="o-building-storefront" link="{{ route('pages:tenants:schools:school') }}" />
                <x-menu-item title="Catologes" icon="o-rectangle-stack" link="{{ route('pages:tenants:schools:school') }}" />
                <x-menu-item title="Products" icon="o-shopping-bag" link="{{ route('pages:tenants:schools:school') }}" />
                <x-menu-item title="Customers" icon="o-users" link="{{ route('pages:tenants:schools:school') }}" /> --}}
                <x-menu-separator title="Parametres"/>
                <x-menu-item title="Annee scolaire" icon="o-calendar" link="{{ route('pages:tenants:schools:anneescolaires') }}" />
                <x-menu-item title="Cycles" icon="o-presentation-chart-line" link="{{ route('pages:tenants:schools:school') }}" />
                <x-menu-item title="Niveau" icon="o-presentation-chart-bar" link="{{ route('pages:tenants:schools:school') }}" />

                <x-menu-separator title="Gestion éleves"/>
                <x-menu-item title="Parent d'éleves" icon="o-user" link="####" />
                <x-menu-item title="Admissions" icon="o-magnifying-glass-circle" link="####" />
                <x-menu-item title="Eleves" icon="o-user-group" link="####" />

                <x-menu-separator title="Gestion inscriptions"/>
                <x-menu-item title="Admissions" icon="o-archive-box" link="####" />
                <x-menu-item title="Inscriptions" icon="o-academic-cap" link="####" />
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />
</body>
</html>
