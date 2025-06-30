<nav x-data="{ open: false }" class="relative z-50 bg-white/80 backdrop-blur-lg shadow-sm border-b border-emerald-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo & Primary Links -->
            <div class="flex">
                <!-- Logo / Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-1 text-2xl font-semibold text-emerald-700">
                        <x-phosphor-plant class="w-6 h-6" />
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
                {{-- shopping cart --}}
                @livewire('partials.mini-basket')

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-600 hover:text-emerald-700 focus:outline-none transition">
                            <span>{{ Auth::user()->name ?? __('Account') }}</span>
                            <x-phosphor-caret-down class="ml-1 h-4 w-4" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Manage Account -->
                        @auth
                            <x-dropdown-link :href="route('profile.show')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('user.history')">
                                {{ __('History') }}
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
                                <x-dropdown-link :href="route('admin.suppliers')">
                                    {{ __('Suppliers') }}
                                </x-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                                <x-dropdown-link :href="route('admin.users')">
                                    {{ __('Users') }}
                                </x-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                                <x-dropdown-link :href="route('admin.orders')">
                                    {{ __('Orders') }}
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
                    <x-phosphor-list class="h-6 w-6" x-show="!open" />
                    <x-phosphor-x class="h-6 w-6" x-show="open" />
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
            <x-nav-link :href="route('shop')" :active="request()->routeIs('shop')" class="block pl-3 pr-4 text-base">
                {{ __('Shop') }}
            </x-nav-link>
            <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="block pl-3 pr-4 text-base">
                {{ __('Contact') }}
            </x-nav-link>
        </div>

        <!-- Mobile Shopping Cart -->
        <div class="pt-2 pb-3 border-t border-gray-200">
            <div class="px-4">
                @livewire('partials.mini-basket')
            </div>
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
                <x-nav-link :href="route('user.history')" class="block pl-3 pr-4 text-base">
                    {{ __('History') }}
                </x-nav-link>

                @if(auth()->user()->admin)
                    <div class="px-4 py-2 text-xs text-gray-400 mt-3">Admin</div>
                    <x-nav-link :href="route('admin.products')" class="block pl-3 pr-4 text-base">
                        {{ __('Products') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.categories')" class="block pl-3 pr-4 text-base">
                        {{ __('Categories') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.suppliers')" class="block pl-3 pr-4 text-base">
                        {{ __('Suppliers') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.users')" class="block pl-3 pr-4 text-base">
                        {{ __('Users') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.orders')" class="block pl-3 pr-4 text-base">
                        {{ __('Orders') }}
                    </x-nav-link>
                @endif

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
