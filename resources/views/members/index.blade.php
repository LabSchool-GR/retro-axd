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
            <!-- Main container with border and shadow -->
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Header bar with icon and title -->
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-users mr-2 text-blue-600"></i>
                        {{ __('members.members_list') }}
                    </h2>
                </div>

                <!-- Main content area -->
                <div class="p-4 sm:p-6">
                    {{-- Flash success message --}}
                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    {{-- Member table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto text-sm text-left text-gray-700 border border-gray-300 rounded-md">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-4 py-2 text-center w-12">A/A</th>
                                    <th class="px-6 py-2">{{ __('Name') }}</th>
                                    <th class="px-6 py-2">{{ __('Lastname') }}</th>
                                    <th class="px-6 py-2">{{ __('Email') }}</th>
                                    <th class="px-6 py-2">{{ __('Phone') }}</th>
                                    <th class="px-6 py-2">{{ __('Location') }}</th>
                                    <th class="px-6 py-2">{{ __('Role') }}</th>
                                    <th class="px-6 py-2 text-right">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                {{-- Loop through all users --}}
                                @forelse ($users as $index => $user)
                                    <tr class="hover:bg-gray-50">
                                        {{-- Index number --}}
                                        <td class="px-4 py-2 text-center">
                                            {{ $index + 1 }}
                                        </td>
                                        {{-- User info --}}
                                        <td class="px-6 py-2">{{ $user->name }}</td>
                                        <td class="px-6 py-2">{{ $user->lastname }}</td>
                                        <td class="px-6 py-2">{{ $user->email }}</td>
                                        <td class="px-6 py-2">{{ $user->phone ?? '-' }}</td>
                                        <td class="px-6 py-2">{{ $user->location ?? '-' }}</td>
                                        {{-- Display roles as comma-separated values --}}
                                        <td class="px-6 py-2">
                                            {{ $user->getRoleNames()->implode(', ') }}
                                        </td>
                                        {{-- Edit button --}}
                                        <td class="px-6 py-2 text-right">
                                            <a href="{{ route('admin.members.edit', $user) }}"
                                               class="text-blue-600 hover:text-blue-800"
                                               title="{{ __('members.edit_member') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                {{-- If no users found --}}
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-400">
                                            {{ __('members.no_members_found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Uncomment below if pagination is needed --}}
                    {{-- <div class="mt-4">
                        {{ $users->withQueryString()->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
