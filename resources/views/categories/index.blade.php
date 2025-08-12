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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

               <!-- Κεφαλίδα σαν καρτέλα με κουμπί -->
				<div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
					<h2 class="text-lg font-semibold text-gray-700 flex items-center">
						<i class="fas fa-folder-open mr-2 text-blue-600"></i>
						{{ __('categories.categories') }}
					</h2>
					<a href="{{ route('admin.categories.create') }}"
					   class="text-blue-600 hover:text-blue-800 text-lg"
					   title="{{ __('categories.new_category') }}">
						<i class="fas fa-plus"></i>
					</a>
				</div>

                <!-- Περιεχόμενο -->
                <div class="p-4 sm:p-6">
                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto text-sm text-left text-gray-700 border border-gray-300 rounded-md">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-4 py-2 text-center w-12">A/A</th>
                                    <th class="px-6 py-2">
                                        <a href="{{ route('admin.categories.index', ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
                                           class="flex items-center hover:underline">
                                            <i class="fas fa-sort mr-1"></i>
                                            {{ __('categories.name') }}
                                        </a>
                                    </th>
                                    <th class="px-6 py-2">{{ __('categories.slug') }}</th>
                                    <th class="px-6 py-2">{{ __('categories.description') }}</th>
                                    <th class="px-6 py-2 text-right">{{ __('categories.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($categories as $index => $category)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 text-center">
                                            {{ ($categories->currentPage() - 1) * $categories->perPage() + $index + 1 }}
                                        </td>
                                        <td class="px-6 py-2">{{ $category->name }}</td>
                                        <td class="px-6 py-2 text-gray-600">{{ $category->slug }}</td>
                                        <td class="px-6 py-2 text-gray-600">{{ $category->description }}</td>
                                        <td class="px-6 py-2 text-right">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.categories.edit', $category) }}"
                                                   class="text-blue-600 hover:text-blue-800" title="{{ __('categories.edit_category') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('{{ __('categories.sur_delete') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800" title="{{ __('categories.delete') }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                                            {{ __('categories.no_categories') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $categories->withQueryString()->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
