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
    @section('title', __('items.edit') . ': ' . $item->title)

    <div class="bg-gray-100 py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Header -->
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-edit mr-2 text-blue-600"></i>
                        {{ __('items.edit') }}: {{ $item->title }}
                    </h2>
                    <a href="{{ route('items.index') }}"
                       class="text-blue-600 hover:text-blue-800 text-lg"
                       title="{{ __('items.back_to_list') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Form -->
                <div class="p-4 sm:p-6">
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-300 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Τίτλος --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">{{ __('items.title') }}</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $item->title) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            @error('title') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="mb-4">
                            <label for="slug" class="block text-sm font-medium text-gray-700">{{ __('items.slug') }}</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $item->slug) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            @error('slug') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Κατηγορία --}}
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">{{ __('items.category') }}</label>
                            <select name="category_id" id="category_id"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Company --}}
                        <div class="mb-4">
                            <label for="company" class="block text-sm font-medium text-gray-700">{{ __('items.company') }}</label>
                            <input type="text" name="company" id="company" value="{{ old('company', $item->company) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        {{-- Serial Number --}}
                        <div class="mb-4">
                            <label for="serial_number" class="block text-sm font-medium text-gray-700">{{ __('items.serial_number') }}</label>
                            <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', $item->serial_number) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        {{-- Link --}}
                        <div class="mb-4">
                            <label for="link" class="block text-sm font-medium text-gray-700">{{ __('items.link') }}</label>
                            <input type="url" name="link" id="link" value="{{ old('link', $item->link) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        {{-- Year --}}
                        <div class="mb-4">
                            <label for="year" class="block text-sm font-medium text-gray-700">{{ __('items.year') }}</label>
                            <input type="text" name="year" id="year" maxlength="4" value="{{ old('year', $item->year) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        {{-- Location --}}
						<div class="mb-4">
							<label for="location" class="block text-sm font-medium text-gray-700">{{ __('items.location') }}</label>
							<select name="location" id="location"
									class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
								<option value="Χώρος Συλλόγου" {{ old('location', $item->location) == 'Χώρος Συλλόγου' ? 'selected' : '' }}>
									Χώρος Συλλόγου
								</option>
								<option value="Αποθήκη Ιδιοκτήτη" {{ old('location', $item->location) == 'Αποθήκη Ιδιοκτήτη' ? 'selected' : '' }}>
									Αποθήκη Ιδιοκτήτη
								</option>
								<option value="Χώρος Έκθεσης" {{ old('location', $item->location) == 'Χώρος Έκθεσης' ? 'selected' : '' }}>
									Χώρος Έκθεσης
								</option>
							</select>
							@error('location')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
						</div>

                        {{-- Status --}}
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('items.status') }}</label>
                            <input type="text" name="status" id="status" value="{{ old('status', $item->status) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('items.description') }}</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">{{ old('description', $item->description) }}</textarea>
                        </div>

                        {{-- Νέες εικόνες --}}
                        <div class="mb-4">
                            <label for="images" class="block text-sm font-medium text-gray-700">{{ __('items.images') }}</label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            <p class="text-sm text-gray-500 mt-1">{{ __('items.image_note') }}</p>
                        </div>

                        {{-- Attributes --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">{{ __('items.additional_attributes') }}</label>
                            <div id="attribute-fields" class="space-y-2 mt-2">
                                @foreach ($item->attributes as $attr)
                                    <div class="flex gap-2">
                                        <input type="text" name="attributes[key][]" value="{{ $attr->attribute_name }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md"
                                               placeholder="{{ __('items.attribute_key') }}">
                                        <input type="text" name="attributes[value][]" value="{{ $attr->attribute_value }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md"
                                               placeholder="{{ __('items.attribute_value') }}">
                                        <button type="button" onclick="this.parentElement.remove()"
                                                class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addAttributeField()"
                                    class="mt-2 text-sm text-blue-600 hover:underline">
                                <i class="fas fa-plus-circle mr-1"></i>{{ __('items.add_attribute') }}
                            </button>
                        </div>

                        {{-- Submit --}}
                        <div class="mt-6">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('items.save') }}
                            </button>
                        </div>
                    </form>
					{{-- Προεπισκόπηση εικόνων και διαγραφή --}}
					@if ($item->images->count())
						<div class="mb-4">
							<label class="block text-sm font-medium text-gray-700">{{ __('items.existing_images') }}</label>
							<div class="flex flex-wrap gap-4 mt-2">
								@foreach ($item->images as $img)
									<div class="relative group">
										<img src="{{ asset('storage/' . $img->image_path) }}"
											 alt="image"
											 class="w-32 h-24 object-contain border border-gray-300 rounded shadow-md" />

										<form action="{{ route('item-images.destroy', $img->id) }}" method="POST"
											  onsubmit="return confirm('Θέλετε σίγουρα να διαγράψετε την εικόνα;')"
											  class="absolute top-1 right-1 bg-white bg-opacity-90 rounded-full shadow-sm group-hover:opacity-100 opacity-0 transition-opacity">
											@csrf
											@method('DELETE')
											<button type="submit" class="text-red-600 text-xs p-1 hover:text-red-800">
												<i class="fas fa-trash-alt"></i>
											</button>
										</form>
									</div>
								@endforeach
							</div>
						</div>
					@endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function addAttributeField() {
            const container = document.getElementById('attribute-fields');
            const wrapper = document.createElement('div');
            wrapper.classList.add('flex', 'gap-2');

            wrapper.innerHTML = `
                <input type="text" name="attributes[key][]" placeholder="{{ __('items.attribute_key') }}"
                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md" />
                <input type="text" name="attributes[value][]" placeholder="{{ __('items.attribute_value') }}"
                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md" />
                <button type="button" onclick="this.parentElement.remove()"
                        class="text-red-600 hover:text-red-800">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            container.appendChild(wrapper);
        }
    </script>
</x-app-layout>
