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
            <div class="pt-5 ml-5">App</div>
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
            <div class="pt-5 ml-5">Tenancy Admin</div>

            {{-- MENU --}}
            <x-menu title="{{ null }}" activate-by-route>

                @if(auth()->check())
                    <x-menu-separator />

                    {{-- User --}}
                    <livewire:admin.user-menu />

                    <x-menu-separator />
                @endif

                @if(Auth::user()->is_admin == 1)
                <x-menu-item title="Dashboard" icon="o-sparkles" link="/" />
                <x-menu-item title="Users" icon="o-user-group" link="{{ route('pages:users') }}" />
                @endif
                <x-menu-item title="Tenants" icon="o-circle-stack" link="{{ route('pages:tenants')}}" />
                <x-menu-item title="Applications" icon="o-cube" link="{{ route('pages:apps') }}" />
                <x-menu-item title="Customers" icon="o-users" link="####" />
                <x-menu-item title="Renouvellement abonnements" icon="o-currency-euro" link="{{ route('pages:abonnements') }}" />
                {{-- <x-menu-sub title="Applications" icon="o-cpu-chip">
                    <x-menu-item title="Applications" icon="o-cube" link="{{ route('pages:apps') }}" />
                    <x-menu-item title="Modules application" icon="o-archive-box" link="{{ route('pages:modules') }}" />
                    <x-menu-item title="Packs application" icon="o-archive-box" link="####" />
                </x-menu-sub> --}}
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast position="toast-top toast-center" />
</body>
</html>
