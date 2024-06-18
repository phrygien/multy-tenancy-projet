@props(['title' => config('app.name'), 'tenant' => tenant()])

<x-layouts.app title="{{ $title }}" :tenant="$tenant">
    <div class="py-12 lg:grid lg:grid-cols-12">
        <aside class="flex items-start justify-center w-full px-2 py-6 sm:px-6 lg:col-span-1 lg:px-0 lg:py-0">
            <nav class="space-y-1">
                <a
                    href="{{ route('pages:tenants:settings:profile') }}"
                    @class([
                        'bg-slate-200 dark:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => request()->routeIs('pages:tenants:settings:profile'),
                        'bg-slate-50 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => ! request()->routeIs('pages:tenants:settings:profile'),
                    ])

                >
                    <x-icons.profile class="flex-shrink-0 w-6 h-6 mr-3 -ml-1 group-hover:text-indigo-500" />
                    <span class="sr-only">Ajouter school</span>
                </a>
                <a
                    href="{{ route('pages:tenants:settings:tenant') }}"
                    @class([
                        'bg-slate-200 dark:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => request()->routeIs('pages:tenants:settings:tenant'),
                        'bg-slate-50 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => ! request()->routeIs('pages:tenants:settings:tenant'),
                    ])

                >
                    <x-icons.tenant class="flex-shrink-0 w-6 h-6 mr-3 -ml-1 group-hover:text-indigo-500" />
                    <span class="sr-only">Ajouter Annee</span>
                </a>
                <a
                href="{{ route('pages:tenants:settings:tenant') }}"
                @class([
                    'bg-slate-200 dark:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => request()->routeIs('pages:tenants:settings:tenant'),
                    'bg-slate-50 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => ! request()->routeIs('pages:tenants:settings:tenant'),
                ])

            >
                <x-icons.tenant class="flex-shrink-0 w-6 h-6 mr-3 -ml-1 group-hover:text-indigo-500" />
                <span class="sr-only">Ajouter Annee</span>
            </a>
            <a
            href="{{ route('pages:tenants:settings:tenant') }}"
            @class([
                'bg-slate-200 dark:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => request()->routeIs('pages:tenants:settings:tenant'),
                'bg-slate-50 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => ! request()->routeIs('pages:tenants:settings:tenant'),
            ])

        >
            <x-icons.tenant class="flex-shrink-0 w-6 h-6 mr-3 -ml-1 group-hover:text-indigo-500" />
            <span class="sr-only">Ajouter Annee</span>
        </a>

            </nav>
        </aside>

        {{ $slot }}
    </div>
</x-layouts.app>
