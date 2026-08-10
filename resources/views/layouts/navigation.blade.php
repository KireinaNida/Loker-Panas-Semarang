<nav x-data="{ open: false }" class="bg-[#FBF8F1]/90 backdrop-blur border-b border-[#EDE4D0] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('beranda') }}" class="flex items-center gap-2.5 shrink-0">
                    <div class="w-9 h-9 rounded-xl bg-[#E0511D] text-white flex items-center justify-center text-lg font-bold shadow-sm">
                        🔥
                    </div>
                    <span class="font-['Sora'] font-bold text-[17px] text-[#2E2118] leading-tight">
                        Info Loker <span class="text-[#E0511D]">Panas</span>
                    </span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:ms-10 sm:flex">
                    <a href="{{ route('beranda') }}"
                       class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2 transition
                              {{ request()->routeIs('beranda') ? 'border-[#E0511D] text-[#2E2118]' : 'border-transparent text-[#7A6C5D] hover:text-[#2E2118] hover:border-[#F0C23A]' }}">
                        Beranda
                    </a>
                    <a href="{{ route('lowongan.index') }}"
                       class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2 transition
                              {{ request()->routeIs('lowongan.*') ? 'border-[#E0511D] text-[#2E2118]' : 'border-transparent text-[#7A6C5D] hover:text-[#2E2118] hover:border-[#F0C23A]' }}">
                        Lowongan
                    </a>
                    @auth
                    <a href="{{ route('favorit.index') }}"
                       class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2 transition
                              {{ request()->routeIs('favorit.*') ? 'border-[#E0511D] text-[#2E2118]' : 'border-transparent text-[#7A6C5D] hover:text-[#2E2118] hover:border-[#F0C23A]' }}">
                        Favorit
                    </a>
                    @endauth
                </div>
            </div>

            <!-- Right side: auth dropdown atau tombol login/register -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-md text-[#7A6C5D] hover:text-[#2E2118] focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-[10px] text-sm font-semibold text-[#2E2118] hover:bg-[#FFF3D2] transition">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-[10px] text-sm font-semibold bg-[#2E2118] text-white hover:bg-[#3B2A1E] transition">Daftar</a>
                </div>
                @endauth
            </div>

            <!-- Hamburger (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#7A6C5D] hover:text-[#2E2118] hover:bg-[#FFF3D2] focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-[#EDE4D0]">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('beranda') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium
                {{ request()->routeIs('beranda') ? 'border-[#E0511D] text-[#2E2118] bg-[#FFF3D2]' : 'border-transparent text-[#7A6C5D]' }}">
                Beranda
            </a>
            <a href="{{ route('lowongan.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium
                {{ request()->routeIs('lowongan.*') ? 'border-[#E0511D] text-[#2E2118] bg-[#FFF3D2]' : 'border-transparent text-[#7A6C5D]' }}">
                Lowongan
            </a>
            @auth
            <a href="{{ route('favorit.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium
                {{ request()->routeIs('favorit.*') ? 'border-[#E0511D] text-[#2E2118] bg-[#FFF3D2]' : 'border-transparent text-[#7A6C5D]' }}">
                Favorit
            </a>
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-[#EDE4D0]">
            <div class="px-4">
                <div class="font-medium text-base text-[#2E2118]">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-[#7A6C5D]">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-[#7A6C5D]">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block pl-3 pr-4 py-2 text-base font-medium text-[#7A6C5D]">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-3 border-t border-[#EDE4D0] px-4 space-y-2">
            <a href="{{ route('login') }}" class="block text-center px-4 py-2 rounded-[10px] text-sm font-semibold text-[#2E2118] border border-[#EDE4D0]">Masuk</a>
            <a href="{{ route('register') }}" class="block text-center px-4 py-2 rounded-[10px] text-sm font-semibold bg-[#2E2118] text-white">Daftar</a>
        </div>
        @endauth
    </div>
</nav>