<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">

        @livewireStyles
    </head>
    <body class="h-screen w-screen overflow-hidden">

        <div x-data="{ showSidebar: true }">
            <nav>
                @livewire('layouts.navbar')
            </nav>

            <div class="flex">
                <aside :class="{ 'ml-[-260px]': !showSidebar }" class="transition-all duration-200">
                    @livewire('layouts.sidebar')
                </aside>

                <main class="p-6 w-full h-[calc(100vh-50px)]">
                    @include('components.alert')

                    {{ $slot }}
                </main>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
