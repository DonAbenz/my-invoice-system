<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="h-full">

    <body class="h-full">
        <div x-data="{ open: false, routeName: '{{ request()->route()->getName() }}' }" @keydown.window.escape="open = false">

            <div x-show="open" class="relative z-50 lg:hidden"
                x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog"
                aria-modal="true" style="display: none;">

                <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-linear duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-900/80"
                    x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state."
                    style="display: none;"></div>


                <div class="fixed inset-0 flex">

                    <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
                        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in-out duration-300 transform"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                        x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                        class="relative mr-16 flex w-full max-w-xs flex-1" @click.away="open = false"
                        style="display: none;">

                        <div x-show="open" x-transition:enter="ease-in-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            x-description="Close button, show/hide based on off-canvas menu state."
                            class="absolute left-full top-0 flex w-16 justify-center pt-5" style="display: none;">
                            <button type="button" class="-m-2.5 p-2.5" @click="open = false">
                                <span class="sr-only">Close sidebar</span>
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                    </path>
                                </svg>
                            </button>
                        </div>

                        <!-- Sidebar component, swap this element with another sidebar if you like -->
                        @include('layouts.nav.sidebar')
                    </div>

                </div>
            </div>


            <!-- Static sidebar for desktop -->
            <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                @include('layouts.nav.sidebar')
            </div>

            <div class="lg:pl-72">
                @include('layouts.nav.header')

                <main class="py-10">
                    <div class="px-4 sm:px-6 lg:px-8">
                        {{-- <x-placeholder> --}}
                        {{-- <div
                                class="relative h-[576px] overflow-hidden rounded-xl border border-dashed border-gray-400 opacity-75"> --}}
                        {{-- <svg class="absolute inset-0 h-full w-full stroke-gray-900/10" fill="none">
                                    <defs>
                                        <pattern id="pattern-1526ac66-f54a-4681-8fb8-0859d412f251" x="0"
                                            y="0" width="10" height="10" patternUnits="userSpaceOnUse">
                                            <path d="M-3 13 15-5M-5 5l18-18M-1 21 17 3"></path>
                                        </pattern>
                                    </defs>
                                    <rect stroke="none" fill="url(#pattern-1526ac66-f54a-4681-8fb8-0859d412f251)"
                                        width="100%" height="100%"></rect>
                                </svg> --}}
                        {{ $slot }}
                        {{-- </div> --}}
                        {{-- </x-placeholder> --}}
                    </div>
                </main>
            </div>
        </div>
        @stack('modals')
        @livewireScripts
        <script src="{{ asset('js/component.js') }}"></script>
    </body>

</html>
