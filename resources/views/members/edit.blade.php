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
    <div class="bg-gray-100 py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Header tab -->
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-user-edit mr-2 text-purple-600"></i>
                        {{ __('members.edit_member') }}
                    </h2>
                    <a href="{{ route('admin.members.index') }}"
                       class="text-gray-600 hover:text-gray-800 text-lg"
                       title="{{ __('categories.back') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Form content -->
                <div class="p-4 sm:p-6 font-mono">
                    <form method="POST" action="{{ route('admin.members.update', $member) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-1">
                                <i class="fas fa-user text-purple-600 mr-1"></i>{{ __('Name') }}
                            </label>
                            <input type="text" name="name" id="name"
                                   value="{{ old('name', $member->name) }}"
                                   class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                            @error('name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lastname -->
                        <div class="mb-6">
                            <label for="lastname" class="block text-sm font-bold text-gray-700 mb-1">
                                <i class="fas fa-user-tag text-purple-600 mr-1"></i>{{ __('Lastname') }}
                            </label>
                            <input type="text" name="lastname" id="lastname"
                                   value="{{ old('lastname', $member->lastname) }}"
                                   class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                            @error('lastname')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email (readonly) -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-1">
                                <i class="fas fa-envelope text-purple-600 mr-1"></i>{{ __('Email') }}
                            </label>
                            <input type="email" id="email"
                                   value="{{ $member->email }}"
                                   readonly
                                   class="block w-full px-4 py-2 bg-gray-100 text-gray-500 border border-gray-300 rounded-md shadow-sm cursor-not-allowed">
                        </div>

                        <!-- Phone -->
                        <div class="mb-6">
                            <label for="phone" class="block text-sm font-bold text-gray-700 mb-1">
                                <i class="fas fa-phone text-purple-600 mr-1"></i>{{ __('Phone') }}
                            </label>
                            <input type="text" name="phone" id="phone"
                                   value="{{ old('phone', $member->phone) }}"
                                   class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                            @error('phone')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="mb-6">
                            <label for="location" class="block text-sm font-bold text-gray-700 mb-1">
                                <i class="fas fa-map-marker-alt text-purple-600 mr-1"></i>{{ __('Location') }}
                            </label>
                            <input type="text" name="location" id="location"
                                   value="{{ old('location', $member->location) }}"
                                   class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                            @error('location')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role selection -->
                        <div class="mb-8">
                            <label for="role" class="block text-sm font-bold text-gray-700 mb-1">
                                <i class="fas fa-user-shield text-purple-600 mr-1"></i>{{ __('Role') }}
                            </label>
                            <select name="role" id="role"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        @if ($member->hasRole($role->name)) selected @endif>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end space-x-2">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-purple-700 text-white text-sm font-semibold rounded hover:bg-purple-800 transition">
                                <i class="fas fa-save mr-1"></i>{{ __('members.update_member') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
