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
    @section('title', __('public_catalog.page_title'))

    <div class="bg-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Header with icon and print button -->
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-desktop mr-2 text-blue-600"></i>
                        {{ __('public_catalog.page_heading') }}
                    </h2>

                    <div class="flex space-x-2 items-center">
                        <button onclick="window.print()" class="text-green-600 hover:text-green-800 text-lg" title="{{ __('public_catalog.print') }}">
                            <i class="fas fa-print"></i>
                        </button>
                    </div>
                </div>

                <!-- Body content -->
                <div class="p-4 sm:p-6">

                    <!-- Search and Category Filter -->
                    <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Αναζήτηση -->
                        <form method="GET" action="{{ route('public.catalog') }}" class="flex flex-1 gap-2">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="{{ __('public_catalog.search_placeholder') }}"
                                class="px-3 py-2 w-full md:w-72 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                            />
                            <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded-md">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('public.catalog') }}" class="px-3 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </form>

                        <!-- Φίλτρο Κατηγορίας -->
                        <form method="GET" action="{{ route('public.catalog') }}">
                            <select
                                name="category"
                                onchange="this.form.submit()"
                                class="w-full md:w-64 px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                            >
                                <option value="">{{ __('public_catalog.all_categories') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <!-- Items Table -->
                    <div class="overflow-x-auto border border-gray-300 rounded-md">
                        <table class="min-w-full table-auto text-sm text-left text-gray-700">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-4 py-2 text-center w-12 cursor-pointer" data-column="0">
                                        {{ __('public_catalog.th_id') }} <span class="sort-icon">↑</span>
                                    </th>
                                    <th class="px-6 py-2 cursor-pointer" data-column="1">
                                        {{ __('public_catalog.th_title') }} <span class="sort-icon">↑</span>
                                    </th>
                                    <th class="px-6 py-2 hidden md:table-cell cursor-pointer" data-column="2">
                                        {{ __('public_catalog.th_company') }} <span class="sort-icon">↑</span>
                                    </th>
                                    <th class="px-6 py-2 hidden md:table-cell cursor-pointer" data-column="3">
                                        {{ __('public_catalog.th_year') }} <span class="sort-icon">↑</span>
                                    </th>
                                    <th class="px-6 py-2 hidden md:table-cell cursor-pointer" data-column="4">
                                        {{ __('public_catalog.th_category') }} <span class="sort-icon">↑</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($items as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 text-center" data-column="0">{{ $item->id }}</td>
                                        <td class="px-6 py-2 text-blue-600 hover:underline" data-column="1">
                                            <a href="{{ route('public.catalog.show', $item->slug) }}">{{ $item->title }}</a>
                                        </td>
                                        <td class="px-6 py-2 hidden md:table-cell text-gray-600" data-column="2">{{ $item->company }}</td>
                                        <td class="px-6 py-2 hidden md:table-cell text-gray-600" data-column="3">{{ $item->year }}</td>
                                        <td class="px-6 py-2 hidden md:table-cell text-gray-600" data-column="4">
                                            {{ $item->category->name ?? __('public_catalog.uncategorized') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                                            {{ __('public_catalog.no_items') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $items->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sorting Script -->
    <script>
        /**
         * Enable client-side sorting by clicking column headers.
         */
        document.addEventListener('DOMContentLoaded', () => {
            const headers = document.querySelectorAll('[data-column]');
            let currentSort = { column: null, direction: 'asc' };

            headers.forEach(header => {
                header.addEventListener('click', () => {
                    const column = header.dataset.column;
                    const rows = Array.from(document.querySelectorAll('tbody tr'));

                    currentSort.direction = currentSort.column === column && currentSort.direction === 'asc' ? 'desc' : 'asc';
                    currentSort.column = column;

                    rows.sort((a, b) => {
                        const aText = a.querySelector(`td[data-column="${column}"]`).textContent.trim();
                        const bText = b.querySelector(`td[data-column="${column}"]`).textContent.trim();
                        const aNum = parseFloat(aText);
                        const bNum = parseFloat(bText);

                        return (!isNaN(aNum) && !isNaN(bNum))
                            ? (currentSort.direction === 'asc' ? aNum - bNum : bNum - aNum)
                            : (currentSort.direction === 'asc'
                                ? aText.localeCompare(bText)
                                : bText.localeCompare(aText));
                    });

                    const tbody = document.querySelector('tbody');
                    tbody.innerHTML = '';
                    rows.forEach(row => tbody.appendChild(row));
                });
            });
        });
    </script>

    <style>
        .sort-icon {
            margin-left: 0.25rem;
            display: inline-block;
        }

        @media print {
            .no-print, .no-print * {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
