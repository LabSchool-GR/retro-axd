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

                <!-- Header καρτέλας -->
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-edit mr-2 text-purple-600"></i>
                        {{ __('categories.edit_category') }}
                    </h2>
                    <a href="{{ route('admin.categories.index') }}"
                       class="text-gray-600 hover:text-gray-800 text-lg"
                       title="{{ __('categories.back') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Περιεχόμενο φόρμας -->
                <div class="p-4 sm:p-6 font-mono">
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-1">
                                <i class="fas fa-tag text-purple-600 mr-1"></i>{{ __('categories.name') }}
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                                   class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                            @error('name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="slug" class="block text-sm font-bold text-gray-700 mb-1">
                                <i class="fas fa-link text-purple-600 mr-1"></i>{{ __('categories.slug') }}
                            </label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}"
                                   class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                            @error('slug')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-8">
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-1">
                                <i class="fas fa-align-left text-purple-600 mr-1"></i>{{ __('categories.description') }}
                            </label>
                            <textarea name="description" id="description" rows="4"
                                      class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-purple-700 text-white text-sm font-semibold rounded hover:bg-purple-800 transition">
                                <i class="fas fa-save mr-1"></i> {{ __('categories.update') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
