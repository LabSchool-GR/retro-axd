{{-- 
  Project: Retro AXD (Laravel 12)
  Copyright (c) 2025 Dimitris Kanatas
  Contact: labschool@sch.gr | https://labschool.gr | https://labschool.mysch.gr

  License: Non-Commercial, Attribution Required.
  You may use, copy, modify, and distribute this software for NON-COMMERCIAL purposes,
  provided you give appropriate credit to the original author:
  Dimitris Kanatas (Labschool.gr / Labschool.mysch.gr).
  Commercial use is prohibited without prior written permission.

  Full terms: see the LICENSE file at the repository root.
--}}

<nav x-data="{ open: false, guestMenu: false, authMenu: false }" class="bg-gradient-to-b from-white via-gray-50 to-gray-100 border-b border-gray-300 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left: Τίτλος και Κατάλογος -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-lg font-semibold text-gray-800 hover:text-blue-600 transition">
                    Retro Guardians AXD
                </a>

                <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.index')">
                    {{ __('Κατάλογος') }}
                </x-nav-link>
            </div>

            <!-- Right: Χρήστες / Επισκέπτες -->
            <div class="hidden sm:flex sm:items-center">
                @auth
                    <div @mouseenter="authMenu = true" @mouseleave="authMenu = false" class="relative">
                        <button class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 transition">
                            <i class="fas fa-user mr-2 text-blue-600"></i>{{ Auth::user()->name }} {{ Auth::user()->lastname }}
                            <svg class="ml-2 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0L5.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="authMenu" x-transition
                             class="absolute right-0 mt-2 w-56 bg-gradient-to-br from-white to-gray-100 border border-gray-300 rounded-md shadow-md z-50">
                            <div class="px-4 py-2 text-gray-700 font-semibold border-b border-gray-200">
                                {{ __('navigation.account_menu') }}
                            </div>

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 transition">
                                <i class="fas fa-user-cog mr-2 text-gray-500"></i>{{ __('navigation.profile') }}
                            </a>
                            <a href="{{ route('messenger.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 transition">
                                <i class="fas fa-upload mr-2 text-gray-500"></i>{{ __('navigation.messenger') }}
                            </a>
							
                            @role('admin')
                                <a href="{{ route('admin.members.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 transition">
                                    <i class="fas fa-users-cog mr-2 text-gray-500"></i>{{ __('navigation.manage_members') }}
                                </a>
                                <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 transition">
                                    <i class="fas fa-tags mr-2 text-gray-500"></i>{{ __('navigation.manage_categories') }}
                                </a>
                            @endrole

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-200 transition">
                                    <i class="fas fa-sign-out-alt mr-2 text-red-500"></i>{{ __('navigation.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Επισκέπτης -->
                    <div @mouseenter="guestMenu = true" @mouseleave="guestMenu = false" class="relative">
                        <button class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 transition">
                            <i class="fas fa-user mr-2 text-gray-500"></i>{{ __('navigation.visitor') }}
                            <svg class="ml-2 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0L5.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="guestMenu" x-transition
                             class="absolute right-0 mt-2 w-44 bg-gradient-to-br from-white to-gray-100 border border-gray-300 rounded-md shadow-md z-50">
                            <div class="px-4 py-2 text-gray-700 font-semibold border-b border-gray-200">
                                {{ __('navigation.visitor_menu') }}
                            </div>
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 transition">
                                <i class="fas fa-sign-in-alt mr-2 text-blue-600"></i>{{ __('navigation.login') }}
                            </a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 transition">
                                <i class="fas fa-user-plus mr-2 text-gray-600"></i>{{ __('navigation.register') }}
                            </a>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Mobile Toggle -->
            <div class="-me-2 flex sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center p-2 rounded-md text-gray-600 hover:bg-gray-200 focus:outline-none">
                    <i :class="open ? 'fas fa-times' : 'fas fa-bars'" class="text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden bg-white border-t border-gray-200">
        <div class="px-4 pt-4 pb-2 space-y-1">
            <x-responsive-nav-link :href="route('items.index')" :active="request()->routeIs('items.index')">
                {{ __('Κατάλογος') }}
            </x-responsive-nav-link>
        </div>

        <div class="border-t border-gray-200 pt-4 pb-4">
            @auth
                <div class="px-4 text-gray-800 font-medium">
                    {{ Auth::user()->name }}
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('navigation.profile') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('messenger.create')">{{ __('navigation.messenger') }}</x-responsive-nav-link>
                    @role('admin')
                        <x-responsive-nav-link :href="route('admin.members.index')">{{ __('navigation.manage_members') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.categories.index')">{{ __('navigation.manage_categories') }}</x-responsive-nav-link>
                    @endrole
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('navigation.logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 text-gray-600">
                    <span class="block text-base font-medium">{{ __('navigation.visitor') }}</span>
                </div>
                <div class="mt-3 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('login')">{{ __('navigation.login') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">{{ __('navigation.register') }}</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
