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
    @section('title', __('items.item_list'))

    <div class="bg-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Header -->
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-desktop mr-2 text-blue-600"></i>
                        {{ __('items.item_list') }}
                    </h2>
                    <div class="flex items-center space-x-4">
					
                        <!-- Toggle: my-items -->
                        @if(Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor')))
                            <a href="{{ route('items.index', array_merge(request()->except('page'), ['mine' => request('mine') ? null : 1])) }}"
                               class="ml-2 text-gray-600 hover:text-blue-600 text-lg"
                               title="{{ request('mine') ? __('items.show_all') : __('items.only_mine') }}">
                                <i class="fas fa-user"></i>
                            </a>
                        @endif

                        <!-- View Mode Toggle -->
                        <a href="{{ route('items.index', array_merge(request()->except('page'), ['view' => request('view') === 'list' ? 'grid' : 'list'])) }}"
                           class="ml-2 text-gray-600 hover:text-blue-600 text-lg"
                           title="{{ request('view') === 'list' ? __('items.view_grid') : __('items.view_list') }}">
                            <i class="fas {{ request('view') === 'list' ? 'fa-th-large' : 'fa-list' }}"></i>
                        </a>

                        <!-- Excel Export Button -->
                        @auth
                            <a href="{{ route('items.export.excel', request()->query()) }}"
                               class="text-green-600 hover:text-green-800 text-lg"
                               title="{{ __('items.export_excel') }}">
                                <i class="fas fa-file-excel"></i>
                            </a>
                        @endauth

                        <!-- Add New Item -->
                        @auth
                            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor'))
                                <a href="{{ route('items.create') }}"
                                   class="text-blue-600 hover:text-blue-800 text-lg"
                                   title="{{ __('items.new_item') }}">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Filters -->
                <div class="p-4 sm:p-6">
                    <div class="mb-4 flex flex-wrap gap-2 md:gap-1.5 items-center justify-between">
                        <!-- Search -->
                        <form method="GET" action="{{ route('items.index') }}" class="flex flex-grow gap-1.5">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="{{ __('items.search_placeholder') }}"
                                   class="px-3 py-1.5 h-9 w-full md:w-72 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" />
                            <button type="submit"
                                    class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1.5 h-9 rounded-md">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('items.index') }}"
                                   class="px-3 py-1.5 h-9 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </form>

                        <!-- Category Filter -->
                        <form method="GET" action="{{ route('items.index') }}" class="w-full md:w-auto">
                            <select name="category"
                                    onchange="this.form.submit()"
                                    class="w-full md:w-64 px-3 py-1.5 h-9 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                                <option value="">{{ __('items.all_categories') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <!-- Dynamic View Section -->
                    @php $viewMode = request('view', 'grid'); @endphp

                    @if($viewMode === 'list')
                        {{-- Table View --}}
                        <div class="overflow-x-auto border border-gray-300 rounded-md">
                            <table class="min-w-full table-auto text-sm text-left text-gray-700">
                                <thead class="bg-gray-50 border-b">
                                    <tr>
                                        @php
                                            $currentSort = request('sort');
                                            $currentDirection = request('direction', 'asc');
                                            $getDirection = fn($col) => ($currentSort === $col && $currentDirection === 'asc') ? 'desc' : 'asc';
                                            $arrow = fn($col) => $currentSort === $col ? ($currentDirection === 'asc' ? '⬆️' : '⬇️') : '';
                                        @endphp
                                        <th class="px-4 py-2 text-center">A/A</th>
                                        <th class="px-6 py-2">
                                            <a href="{{ route('items.index', array_merge(request()->query(), ['sort' => 'title', 'direction' => $getDirection('title')])) }}"
                                               class="flex items-center hover:underline">
                                                <i class="fas fa-sort mr-1"></i>{{ __('items.title') }} {!! $arrow('title') !!}
                                            </a>
                                        </th>
                                        <th class="px-6 py-2 hidden md:table-cell">
                                            <a href="{{ route('items.index', array_merge(request()->query(), ['sort' => 'company', 'direction' => $getDirection('company')])) }}"
                                               class="flex items-center hover:underline">
                                                <i class="fas fa-sort mr-1"></i>{{ __('items.company') }} {!! $arrow('company') !!}
                                            </a>
                                        </th>
                                        <th class="px-6 py-2 hidden md:table-cell">
                                            <a href="{{ route('items.index', array_merge(request()->query(), ['sort' => 'year', 'direction' => $getDirection('year')])) }}"
                                               class="flex items-center hover:underline">
                                                <i class="fas fa-sort mr-1"></i>{{ __('items.year') }} {!! $arrow('year') !!}
                                            </a>
                                        </th>
                                        <th class="px-6 py-2 hidden md:table-cell">{{ __('items.category') }}</th>
                                        <th class="px-6 py-2 text-right">{{ __('items.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($items as $index => $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2 text-center">
                                                {{ ($items->currentPage() - 1) * $items->perPage() + $index + 1 }}
                                            </td>
                                            <td class="px-6 py-2">{{ $item->title }}</td>
                                            <td class="px-6 py-2 hidden md:table-cell">{{ $item->company }}</td>
                                            <td class="px-6 py-2 hidden md:table-cell">{{ $item->year }}</td>
                                            <td class="px-6 py-2 hidden md:table-cell">{{ $item->category->name ?? __('items.uncategorized') }}</td>
                                            <td class="px-6 py-2 text-right">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('items.show', $item->slug) }}"
                                                       class="text-blue-600 hover:text-blue-800" title="{{ __('items.view') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if(Auth::check() && (Auth::user()->hasRole('admin') || Auth::id() === $item->user_id))
                                                        <a href="{{ route('items.edit', $item) }}"
                                                           class="text-green-600 hover:text-green-800" title="{{ __('items.edit') }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('items.destroy', $item) }}" method="POST"
                                                              onsubmit="return confirm('{{ __('items.confirm_delete') }}');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800" title="{{ __('items.delete') }}">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                                                {{ __('items.no_items') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Centered pagination with summary -->
						<div class="mt-6 flex flex-col items-center space-y-2">
							<div class="w-full flex justify-center">
								{{ $items->withQueryString()->links('pagination::tailwind') }}
							</div>
						</div>
						
                    @else
                        {{-- Grid View --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($items as $item)
                                <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition duration-200">
                                    <a href="{{ route('items.show', $item->slug) }}">
                                        @php
                                            $image = $item->images->first()->image_path ?? null;
                                        @endphp
                                        <img src="{{ $image ? asset('storage/' . $image) : asset('images/no-image.png') }}"
                                             alt="{{ $item->title }}"
                                             class="w-full h-48 object-cover rounded-t-lg" loading="lazy">
                                    </a>
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                                            <a href="{{ route('items.show', $item->slug) }}">{{ $item->title }}</a>
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            {{ $item->company }} &middot; {{ $item->year }}
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $item->category->name ?? __('items.uncategorized') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

						<!-- Centered pagination with summary -->
						<div class="mt-6 flex flex-col items-center space-y-2">
							<div class="w-full flex justify-center">
								{{ $items->withQueryString()->links('pagination::tailwind') }}
							</div>
						</div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
