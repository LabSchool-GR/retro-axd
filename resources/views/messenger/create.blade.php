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
    @section('title', __('messenger.contact'))

    <div class="bg-gray-100 py-4 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Card Header -->
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>
                        {{ __('messenger.contact') }}
                    </h2>
                    <a href="{{ route('items.index') }}"
                       class="text-blue-600 hover:text-blue-800 text-lg"
                       title="{{ __('messenger.back') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Card Content -->
                <div class="p-6 font-mono">

                    <!-- Flash message -->
                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Validation errors -->
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-300 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Contact Form -->
                    <form method="POST" action="{{ route('messenger.send') }}">
                        @csrf

                        <!-- Read-only user information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">{{ __('messenger.name') }}</label>
                                <input type="text" readonly class="mt-1 w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2"
                                       value="{{ Auth::user()->name }}">
                            </div>

                            <!-- Lastname -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">{{ __('messenger.lastname') }}</label>
                                <input type="text" readonly class="mt-1 w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2"
                                       value="{{ Auth::user()->lastname }}">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" readonly class="mt-1 w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2"
                                       value="{{ Auth::user()->email }}">
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">{{ __('messenger.phone') }}</label>
                                <input type="text" readonly class="mt-1 w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2"
                                       value="{{ Auth::user()->phone }}">
                            </div>

                            <!-- Location -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">{{ __('messenger.location') }}</label>
                                <input type="text" readonly class="mt-1 w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2"
                                       value="{{ Auth::user()->location }}">
                            </div>
                        </div>

                        <!-- Subject Type Selection -->
                        <div class="mb-6">
                            <label for="subject_type" class="block text-sm font-medium text-gray-700">
                                {{ __('messenger.subject_type') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="subject_type" name="subject_type"
                                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 bg-white shadow-sm"
                                    required>
                                <option value="">{{ __('messenger.choose_type') }}</option>
                                <option value="contact_request">{{ __('messenger.types.contact_request') }}</option>
                                <option value="material_offer">{{ __('messenger.types.material_offer') }}</option>
                                <option value="catalog_editor_request">{{ __('messenger.types.catalog_editor_request') }}</option>
                            </select>
                        </div>

                        <!-- Message Textarea -->
                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium text-gray-700">
                                {{ __('messenger.message') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" name="message" rows="6"
                                      class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm"
                                      required>{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow hover:bg-blue-700 transition">
                                <i class="fas fa-paper-plane mr-2"></i>{{ __('messenger.send') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
