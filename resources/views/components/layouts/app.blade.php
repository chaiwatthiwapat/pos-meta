<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

            * {
                font-family: "Noto Sans Thai", sans-serif;
            }
        </style>

        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body class="h-screen w-screen overflow-hidden">

        <div
            x-data="{ showSidebar: true }"
            x-init="
                const checkScreen = () => {
                    showSidebar = window.matchMedia('(min-width: 1281px)').matches ? true : false;
                };
                checkScreen();
                window.addEventListener('resize', checkScreen)
            ">
            {{--  --}}
            @if(Auth::check())
                <nav>
                    @livewire('layouts.navbar')
                </nav>
            @endif

            <div class="flex w-full h-[calc(100vh-50px)] overflow-hidden">
                @if(Auth::check())
                    <aside :class="showSidebar ? 'ml-0' : '-ml-64'" class="transition-all duration-200 absolute xl:relative z-[1000]">
                        @livewire('layouts.sidebar')
                    </aside>
                @endif

                <main class="p-6 w-full h-[calc(100vh-50px)]">
                    @include('components.alert')

                    {{ $slot }}
                </main>
            </div>
        </div>

        @livewireScripts
    </body>
</html>


