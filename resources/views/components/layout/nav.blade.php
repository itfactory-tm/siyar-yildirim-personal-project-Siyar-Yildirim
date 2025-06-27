<nav x-data="{ open: false }" class="relative z-50 bg-white/80 backdrop-blur-lg shadow-sm border-b border-emerald-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo & Primary Links -->
            <div class="flex">
                <!-- Logo / Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-1 text-2xl font-semibold text-emerald-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.38 0 2.5-1.12 2.5-2.5S13.38 3 12 3 9.5 4.12 9.5 5.5 10.62 8 12 8zM12 8v13M5 21h14" />
                        </svg>
                        Earthify
                    </a>
                </div>

                <!-- Desktop Nav Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex items-center">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                        {{ __('Shop') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Secondary Menu (Cart + User) -->
            <div class="hidden sm:flex sm:items-center gap-4">
                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-600 hover:text-emerald-700 focus:outline-none transition">
                            <span>{{ Auth::user()->name ?? __('Account') }}</span>
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Manage Account -->
                        @auth
                            <x-dropdown-link :href="route('profile.show')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link :href="route('logout')" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                            @if(auth()->user()->admin)
                                <div class="block px-4 py-2 text-xs text-gray-400">Admin</div>

                                <x-dropdown-link :href="route('admin.products')">
                                {{ __('Products') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.categories')">
                                    {{ __('Categories') }}
                                </x-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                                <x-dropdown-link :href="route('admin.users')">
                                    {{ __('Users') }}
                                </x-dropdown-link>
                            @endif
                        @else
                            <x-dropdown-link :href="route('login')">
                                {{ __('Log In') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')">
                                {{ __('Register') }}
                            </x-dropdown-link>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-emerald-700 hover:bg-emerald-50 focus:outline-none focus:bg-emerald-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden bg-white/90">
        <div class="pt-2 pb-3 space-y-1">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="block pl-3 pr-4 text-base">
                {{ __('Home') }}
            </x-nav-link>
            <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="block pl-3 pr-4 text-base">
                {{ __('Contact') }}
            </x-nav-link>
        </div>

        <!-- Mobile User Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4 mb-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <x-nav-link :href="route('profile.show')" class="block pl-3 pr-4 text-base">
                    {{ __('Profile') }}
                </x-nav-link>
                <form method="POST" action="{{ route('logout') }}" class="px-4 mt-3" x-data>
                    @csrf
                    <x-nav-link :href="route('logout')" @click.prevent="$root.submit();" class="block pl-3 pr-4 text-base">
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>
            @else
                <x-nav-link :href="route('login')" class="block pl-3 pr-4 text-base">
                    {{ __('Log In') }}
                </x-nav-link>
                <x-nav-link :href="route('register')" class="block pl-3 pr-4 text-base">
                    {{ __('Register') }}
                </x-nav-link>
            @endauth
        </div>
    </div>
</nav>
