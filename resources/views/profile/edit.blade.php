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

{{-- resources/views/profile/edit.blade.php --}}
<x-app-layout>
    @section('title', __('app.auth.profile'))

    <div class="bg-gray-100 py-4 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Header --}}
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">
                <div class="bg-gray-50 px-4 py-4 border-b border-gray-300 flex items-center justify-center">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-user-circle mr-2 text-indigo-600"></i>
                        {{ __('app.auth.profile') }}
                    </h2>
                </div>
            </div>

            {{-- Update Profile Information --}}
            <div class="bg-white border border-gray-300 rounded-md shadow-sm p-6 md:p-10 font-mono">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Update Password --}}
            <div class="bg-white border border-gray-300 rounded-md shadow-sm p-6 md:p-10 font-mono">
                @include('profile.partials.update-password-form')
            </div>

            {{-- Delete Account --}}
            <div class="bg-white border border-gray-300 rounded-md shadow-sm p-6 md:p-10 font-mono">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
