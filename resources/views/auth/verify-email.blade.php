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

{{-- resources/views/auth/verify-email.blade.php --}}
<x-app-layout>
    @section('title', __('app.auth.verify_email'))

    <div class="bg-gray-100 py-4 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="bg-gray-50 px-4 py-4 border-b border-gray-300 flex items-center justify-center">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-envelope-open-text mr-2 text-yellow-600"></i>
                        {{ __('app.auth.verify_email') }}
                    </h2>
                </div>

                {{-- Content --}}
                <div class="p-6 md:p-10 font-mono">
                    {{-- Description --}}
                    <p class="text-sm text-gray-600 text-center mb-6">
                        {{ __('app.auth.verify_email_text') }}
                    </p>

                    {{-- Session status message --}}
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-6 text-sm text-green-600 text-center font-medium">
                            {{ __('app.auth.verification_resent') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center">
                        {{-- Resend button --}}
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <x-primary-button>
                                {{ __('app.auth.resend_verification') }}
                            </x-primary-button>
                        </form>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 hover:text-red-600 underline">
                                {{ __('app.auth.logout') }}
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
