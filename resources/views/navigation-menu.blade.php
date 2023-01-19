<nav x-data="{ open: false }" class="bg-f-black2 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('movies.index') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('movies.index') }}" :active="request()->routeIs('movie')">
                        {{ __('Movie') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('movies.index') }}" :active="request()->routeIs('tvshow')">
                        {{ __('TV Show') }}
                    </x-jet-nav-link>
                    @auth
                    <x-jet-nav-link href="{{ route('movies.index') }}" :active="request()->routeIs('favorite')">
                        {{ __('Favorite') }}
                    </x-jet-nav-link>
                    @endauth
                    @guest
                    <x-jet-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Log in') }}
                    </x-jet-nav-link>
                    @endguest
                </div>
            </div>

            <div class="bg-f-black2 hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    @auth
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">

                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-f-black2 hover:text-[#D3A748] focus:outline-none focus:bg-f-black1 active:bg-f-black1 transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>

                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                    @endauth
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('movies.index') }}" :active="request()->routeIs('movie')">
                {{ __('Movie') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('movies.index') }}" :active="request()->routeIs('tvshow')">
                {{ __('Tv Show') }}
            </x-jet-responsive-nav-link>

            @auth
            <x-jet-responsive-nav-link href="{{ route('movies.index') }}" :active="request()->routeIs('favorite')">
                {{ __('Favorite') }}
            </x-jet-responsive-nav-link>
            @endauth

            @guest
            <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                {{ __('Log in') }}
            </x-jet-responsive-nav-link>
            @endguest
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 ">
            @auth
            <div class="flex items-center px-4">

                <div>
                    <div class="font-medium text-base text-[#D3A748]">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-[#D3A748]">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
            @endauth
        </div>
    </div>
</nav>
