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
    {{-- Section header --}}
    <header>
        <h2 class="text-lg font-semibold text-gray-700 flex items-center">
            <i class="fas fa-user-slash mr-2 text-red-600"></i>
            {{ __('app.auth.delete_account') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __('app.auth.delete_warning') }}
        </p>
    </header>

    {{-- Trigger delete modal --}}
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        {{ __('app.auth.delete_account') }}
    </x-danger-button>

    {{-- Confirmation modal --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-800">
                {{ __('app.auth.delete_confirm_title') }}
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                {{ __('app.auth.delete_confirm_text') }}
            </p>

            {{-- Password input --}}
            <div class="mt-6">
                <x-input-label for="password" class="sr-only" :value="__('app.registerform.password')" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full max-w-sm"
                    placeholder="{{ __('app.registerform.password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
            </div>

            {{-- Buttons --}}
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('app.auth.cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('app.auth.delete_account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
