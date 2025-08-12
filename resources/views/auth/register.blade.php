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

{{-- resources/views/auth/register.blade.php --}}
<x-app-layout>
    @section('title', __('app.registerform.regform'))

    <div class="bg-gray-100 py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                {{-- Header bar --}}
                <div class="bg-gray-50 px-4 py-4 border-b border-gray-300 flex items-center justify-center">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-user-plus mr-2 text-purple-700"></i>
                        {{ __('app.registerform.regform') }}
                    </h2>
                </div>

                {{-- Form section --}}
                <div class="p-6 md:p-10 font-mono">
                    {{-- Intro text --}}
                    <p class="text-sm text-gray-600 text-center mb-6">
                        {{ __('app.registerform.intro') }}
                    </p>

                    {{-- Registration Form --}}
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- First Name --}}
                        <div class="mb-4">
							<x-input-label for="name" :value="__('app.registerform.name')" />
							<x-text-input id="name" name="name" type="text"
										  class="mt-1 block w-full"
										  :value="old('name')" required autofocus />
							<p class="text-sm text-gray-500 mt-1">
								{{ __('app.registerform.lowercase_hint') }}
							</p>
							<x-input-error :messages="$errors->get('name')" class="mt-1" />
						</div>

                        {{-- Last Name --}}
                        <div class="mb-4">
							<x-input-label for="lastname" :value="__('app.registerform.lastname')" />
							<x-text-input id="lastname" name="lastname" type="text"
										  class="mt-1 block w-full"
										  :value="old('lastname')" required />
							<p class="text-sm text-gray-500 mt-1">
								{{ __('app.registerform.lowercase_hint') }}
							</p>
							<x-input-error :messages="$errors->get('lastname')" class="mt-1" />
						</div>

                        {{-- Phone --}}
                        <div class="mb-4">
                            <x-input-label for="phone" :value="__('app.registerform.phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                        </div>

                        {{-- Location --}}
						<div class="mb-4">
							<x-input-label for="location" :value="__('app.registerform.location')" />
							<x-text-input id="location" name="location" type="text"
										  class="mt-1 block w-full"
										  :value="old('location')" required />
							<p class="text-sm text-gray-500 mt-1">
								{{ __('app.registerform.lowercase_hint') }}
							</p>
							<x-input-error :messages="$errors->get('location')" class="mt-1" />
						</div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('app.registerform.email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        {{-- Password --}}
                        <div class="mb-4">
                            <x-input-label for="password" :value="__('app.registerform.password')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-6">
                            <x-input-label for="password_confirmation" :value="__('app.registerform.confirm_password')" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
                        </div>

                        {{-- Terms Checkbox --}}
                        <div class="mb-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="terms" id="terms" class="form-checkbox text-purple-600" required>
                                <span class="ml-2 text-sm text-gray-700">{{ __('app.registerform.terms') }}</span>
                            </label>
                            <x-input-error :messages="$errors->get('terms')" class="mt-1" />
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="flex justify-between items-center">
                            <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                {{ __('app.auth.cancel') }}
                            </a>

                            <x-primary-button>
                                {{ __('app.auth.register') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>