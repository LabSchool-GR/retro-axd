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

{{-- resources/views/auth/forgot-password.blade.php --}}
<x-app-layout>
    @section('title', __('app.auth.reset_password_request'))

    <div class="bg-gray-100 py-4 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="bg-gray-50 px-4 py-4 border-b border-gray-300 flex items-center justify-center">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-unlock-alt mr-2 text-red-600"></i>
                        {{ __('app.auth.reset_password_request') }}
                    </h2>
                </div>

                {{-- Form Section --}}
                <div class="p-6 md:p-10 font-mono">
                    {{-- Description --}}
                    <p class="text-sm text-gray-600 text-center mb-6">
                        {{ __('app.auth.reset_password_text') }}
                    </p>

                    {{-- Session Status --}}
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    {{-- Reset Password Form --}}
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-6">
                            <x-input-label for="email" :value="__('app.registerform.email')" />
                            <x-text-input id="email" name="email" type="email" :value="old('email')" required autofocus class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('app.auth.send_reset_link') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
