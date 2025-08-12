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

<section class="space-y-6">
    {{-- Header --}}
    <header>
        <h2 class="text-lg font-semibold text-gray-700 flex items-center">
            <i class="fas fa-id-card mr-2 text-indigo-600"></i>
            {{ __('app.auth.profile_information') }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            {{ __('app.auth.profile_info_text') }}
        </p>
    </header>

    {{-- Form για επαναποστολή email επιβεβαίωσης --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Profile update form --}}
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        {{-- Όνομα --}}
        <div>
            <x-input-label for="name" :value="__('app.registerform.name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        {{-- Επώνυμο --}}
        <div>
            <x-input-label for="lastname" :value="__('app.registerform.lastname')" />
            <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full"
                          :value="old('lastname', $user->lastname)" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-1" />
        </div>

        {{-- Τηλέφωνο --}}
        <div>
            <x-input-label for="phone" :value="__('app.registerform.phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                          :value="old('phone', $user->phone)" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
        </div>

        {{-- Περιοχή --}}
        <div>
            <x-input-label for="location" :value="__('app.registerform.location')" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                          :value="old('location', $user->location)" required autocomplete="address-level2" />
            <x-input-error :messages="$errors->get('location')" class="mt-1" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('app.registerform.email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-800">
                    {{ __('app.auth.email_unverified') }}
                    <button form="send-verification" class="underline text-sm text-blue-600 hover:text-blue-800">
                        {{ __('app.auth.resend_verification') }}
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('app.auth.verification_resent') }}
                    </p>
                @endif
            @endif
        </div>

        {{-- Submit --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('app.auth.save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('app.auth.saved') }}</p>
            @endif
        </div>
    </form>
</section>
