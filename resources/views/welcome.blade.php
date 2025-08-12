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

<x-app-layout>
    @section('title', __('app.title'))

    <div class="bg-gray-100 py-4 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Header -->
                <div class="bg-gray-50 px-4 py-4 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center mx-auto">
                        <i class="fas fa-laptop-code mr-2 text-blue-700"></i>
                        {{ __('app.title') }}
                    </h2>
                </div>

                <!-- Content -->
                <div class="p-6 md:p-10 font-mono">

                    <!-- Logo -->
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('storage/retro-guardians-axd-250px.png') }}" alt="Retro Guardians Logo" class="w-64 h-auto">
                    </div>

                    <!-- Description -->
                    <p class="text-center text-base md:text-lg text-gray-700 leading-relaxed mb-8">
                        {{ __('app.description') }}
                    </p>

                    <!-- Authenticated -->
                    @auth
                        <div class="text-center space-y-4 mb-8">
                            <p class="text-lg text-gray-800 font-semibold">
                                {{ __('app.auth.welcome') }}, {{ Auth::user()->name }}!
                            </p>

                            <div class="flex flex-wrap justify-center gap-4">
								{{-- Show "New Entry" button only for admin or reporter --}}
								@if (Auth::user()->hasRole(['admin', 'reporter']))
									<a href="{{ route('items.create') }}"
									   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
										<i class="fas fa-plus-circle mr-2"></i>{{ __('app.auth.new_entry') }}
									</a>
								@endif

								{{-- Show "Contact" button only for regular members (not admin or reporter) --}}
								@unless (Auth::user()->hasAnyRole(['admin', 'reporter']))
									<a href="{{ route('messenger.create') }}"
									   class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md shadow hover:bg-purple-700 transition">
										<i class="fas fa-envelope mr-2"></i>{{ __('app.auth.contact') }}
									</a>
								@endunless

								{{-- Logout button for all authenticated users --}}
								<form method="POST" action="{{ route('logout') }}">
									@csrf
									<button type="submit"
											class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition">
										<i class="fas fa-sign-out-alt mr-2"></i>{{ __('app.auth.logout') }}
									</button>
								</form>
							</div>

													</div>
                    @endauth

                    <!-- Guest -->
                    @guest
                        <div class="text-center space-x-4 mt-4 mb-8">
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
                                <i class="fas fa-sign-in-alt mr-2"></i>{{ __('app.auth.login') }}
                            </a>
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md shadow hover:bg-gray-700 transition">
                                <i class="fas fa-user-plus mr-2"></i>{{ __('app.auth.register') }}
                            </a>
                        </div>
                    @endguest

                    <!-- Divider -->
                    <hr class="my-10 border-gray-300">

                    <!-- Catalog Link -->
                    <div class="text-center mt-6">
                        <a href="{{ route('items.index') }}"
                           class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition">
                            <i class="fas fa-archive mr-2"></i>{{ __('app.catalog.general') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
