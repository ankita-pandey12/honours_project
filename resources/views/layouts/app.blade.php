<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark"> <!-- Add dark class here -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Task Management App</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('task.png') }}" type="image/png">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-gray-100"> <!-- Add background and text colors for dark mode -->
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @if(request()->routeIs('dashboard'))
                    {{ $slot }} <!-- Display the slot content if the dashboard tab is active -->
                @else
                    @yield('content') <!-- Otherwise, display the default content -->
                @endif
            </main>
        </div>
    </body>
</html>