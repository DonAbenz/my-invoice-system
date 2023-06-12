<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Invoice System</title>

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"> --}}

    {{-- <link rel="prefetch" href="{{ asset('fonts') }}/Inter-roman.var.woff2?v=3.18" as="font" type="font/woff2"
        crossorigin="anonymous"> --}}

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

{{-- <body class="antialiased font-sans bg-gray-200 overflow-hidden" data-new-gr-c-s-check-loaded="14.1102.0"
    data-gr-ext-installed=""> --}}

<body class="h-full">
    <div class="flex min-h-full items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-sm space-y-5">
            <div>
                {{-- <img class="mx-auto h-25 w-auto" src="{{ asset('images/logos/PRIME WORLDWIDE v1FE-02.png') }}"
                    alt="Your Company"> --}}
                <h2 class="text-center text-3xl font-bold leading-9 tracking-tight text-[#231f20]">Invoice System</h2>
                <h2 class="mt-10 text-center text-2xl font-semibold leading-9 tracking-tight text-[#231f20]">Register
                    account</h2>
            </div>

            @if ($errors->any())
                <div class="mb-4">
                    <div class="font-medium text-[#C1554D]">{{ __('Whoops! Something went wrong.') }}</div>

                    <ul class="mt-3 list-disc list-inside text-sm text-[#C1554D]">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-[#1B3B31]">
                    {{ session('status') }}
                </div>
            @endif

            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="relative -space-y-px rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-0 z-10 rounded-md ring-1 ring-inset ring-gray-300">
                    </div>
                    <div>
                        <label for="name" class="sr-only">Name</label>
                        <input id="name" name="name" type="text" autocomplete="name" :value="old('name')"
                            class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-100 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-[#4F4537] sm:text-sm sm:leading-6"
                            placeholder="name">
                    </div>
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" name="email" type="email" autocomplete="email"
                            :value="old('email')"
                            class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-100 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-[#4F4537] sm:text-sm sm:leading-6"
                            placeholder="Email address">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-100 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-[#4F4537] sm:text-sm sm:leading-6"
                            placeholder="Password">
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            autocomplete="current-password"
                            class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-100 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-[#4F4537] sm:text-sm sm:leading-6"
                            placeholder="Confirm Password">
                    </div>
                </div>

                {{-- <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-900">Remember me</label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm leading-6">
                            <a href="{{ route('password.request') }}"
                                class="font-semibold text-[#231f20] hover:text-[#EABD5E]">Forgot
                                password?</a>
                        </div>
                    @endif
                </div> --}}

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-[#1B3B31] px-3 py-1.5 text-sm font-semibold leading-6 text-white hover:bg-[#EABD5E] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1B3B31]">
                        Register
                    </button>
                </div>
            </form>

            <p class="text-center text-sm leading-6 text-gray-500">
                Already registered?
                <a href="/login" class="font-semibold text-[#1B3B31] hover:text-[#EABD5E]">Login</a>
            </p>
        </div>
    </div>

    @livewireScripts
    <script src="{{ asset('js/component.js') }}"></script>
</body>

</html>
