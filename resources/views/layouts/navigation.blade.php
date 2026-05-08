<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo (Flat Style) -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gray-900 rounded flex items-center justify-center text-white font-bold text-[10px]">
                            UK
                        </div>
                        <span class="text-[10px] font-bold tracking-[0.3em] uppercase text-gray-900 hidden sm:block">Uang Anak Kos</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-blue-600 text-gray-900' : 'border-transparent text-gray-400 hover:text-gray-700 hover:border-gray-300' }} text-[10px] font-bold uppercase tracking-widest transition">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown (Flat Style) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <div @click="open = ! open">
                        <button class="inline-flex items-center px-3 py-2 border border-gray-100 text-[10px] font-bold uppercase tracking-widest text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 rounded">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
                         style="display: none;"
                         @click="open = false">
                        <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white border border-gray-200">
                            <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2 text-left text-[10px] font-bold uppercase tracking-widest text-gray-700 hover:bg-gray-50 transition">
                                {{ __('Profile') }}
                            </a>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   class="block w-full px-4 py-2 text-left text-[10px] font-bold uppercase tracking-widest text-red-600 hover:bg-red-50 transition"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-blue-600 text-blue-700 bg-blue-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50' }} text-[10px] font-bold uppercase tracking-widest transition">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-bold text-xs text-gray-900 uppercase tracking-widest">{{ Auth::user()->name }}</div>
                <div class="font-medium text-[10px] text-gray-500 uppercase tracking-widest">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 text-[10px] font-bold uppercase tracking-widest transition">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-red-600 hover:text-red-800 hover:bg-red-50 text-[10px] font-bold uppercase tracking-widest transition"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
