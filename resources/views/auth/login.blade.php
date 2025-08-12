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

{{-- resources/views/auth/login.blade.php --}}
<x-app-layout>
    @section('title', __('app.auth.login'))

    <div class="bg-gray-100 py-4 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="bg-gray-50 px-4 py-4 border-b border-gray-300 flex items-center justify-center">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-sign-in-alt mr-2 text-blue-600"></i>
                        {{ __('app.auth.login') }}
                    </h2>
                </div>

                {{-- Form --}}
                <div class="p-6 md:p-10 font-mono">
                    {{-- Session status message --}}
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('app.registerform.email')" />
                            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        {{-- Password --}}
                        <div class="mb-4">
                            <x-input-label for="password" :value="__('app.registerform.password')" />
                            <x-text-input id="password" type="password" name="password" required class="mt-1 block w-full" autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-6">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="form-checkbox text-blue-600" name="remember">
                                <span class="ml-2 text-sm text-gray-700">{{ __('app.auth.remember_me') ?? 'Να με θυμάσαι' }}</span>
                            </label>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex justify-between items-center">
                            @if (Route::has('password.request'))
                                <a class="text-sm text-gray-600 hover:text-blue-600 underline" href="{{ route('password.request') }}">
                                    {{ __('app.auth.forgot_password') ?? 'Ξέχασες τον κωδικό;' }}
                                </a>
                            @endif

                            <x-primary-button>
                                {{ __('app.auth.login') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
