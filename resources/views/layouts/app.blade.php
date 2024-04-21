<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (View::hasSection('title'))
        @yield('title') |
        @endif
        {{ config('app.name', 'Laravel') }}
    </title>

</head>

<body>
    <div id="app">
        <nav class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="{{ url('/') }}" class="text-white font-bold">Home</a>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                @auth
                                <a href="{{ route('characters.index') }}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Karakterek</a>
                                <a href="{{ route('contests.index') }}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Mérkőzések</a>
                                @if(auth()->user()->admin)
                                <a href="{{ route('places.index') }}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Helyszínek</a>
                                @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            @guest
                            <a href="{{ route('login') }}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                            @else
                            <div class="ml-3 relative">
                                <div>
                                    <button type="button" class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <span class="inline-block h-8 w-8 rounded-full overflow-hidden bg-gray-100">
                                        </span>
                                    </button>
                                </div>
                                <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                    <div class="py-1" role="none">
                                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    </div>
                                </div>
                            </div>
                            @endguest
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button type="button" class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    @auth
                    <a href="{{ route('characters.index') }}" class="text-white hover:bg-gray-700 block px-3 py-2 rounded-md text-base font-medium">Karakterek</a>
                    <a href="{{ route('contests.index') }}" class="text-white hover:bg-gray-700 block px-3 py-2 rounded-md text-base font-medium">Mérkőzések</a>
                    @if(auth()->user()->admin)
                    <a href="{{ route('places.index') }}" class="text-white hover:bg-gray-700 block px-3 py-2 rounded-md text-base font-medium">Helyszínek</a>
                    @endif
                    @endauth
                    @guest
                    <a href="{{ route('login') }}" class="text-white hover:bg-gray-700 block px-3 py-2 rounded-md text-base font-medium">Login</a>
                    <a href="{{ route('register') }}" class="text-white hover:bg-gray-700 block px-3 py-2 rounded-md text-base font-medium">Register</a>
                    @else
                    <a href="{{ route('logout') }}" class="text-white hover:bg-gray-700 block px-3 py-2 rounded-md text-base font-medium" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    @endguest
                </div>
            </div>
        </nav>


        <main class="h-fit">
            @yield('content')
        </main>

        <footer class="mb-4">
            <div class="container">
            </div>
        </footer>

        @yield('scripts')
    </div>
</body>

</html>