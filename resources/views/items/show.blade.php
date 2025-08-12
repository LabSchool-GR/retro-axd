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
    @section('title', "#{$item->id} - {$item->title}")

    {{-- Open Graph meta tags for social previews --}}
    @push('meta')
        <meta property="og:title" content="{{ $item->title }}" />
        <meta property="og:description" content="{{ Str::limit(strip_tags($item->description), 150) }}" />
        <meta property="og:image" content="{{ asset('storage/' . $item->images->first()?->image_path) }}" />
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="article" />
    @endpush

    <div class="bg-gray-100 py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm">

                {{-- Header with title and print/pdf buttons --}}
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-300 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-700">
                        #{{ $item->id }} - {{ $item->title }}
                    </h2>

                    <div class="flex gap-3 items-center no-print">
                        {{-- Print button --}}
                        <button onclick="window.print()" class="text-gray-600 hover:text-gray-800" title="{{ __('items.print') }}">
                            <i class="fas fa-print"></i>
                        </button>

                        {{-- PDF export --}}
						@auth
                        <a href="{{ route('items.downloadPdf', $item) }}"
                           class="text-gray-600 hover:text-gray-800"
                           title="{{ __('items.download_pdf') }}">
                            <i class="fas fa-file-pdf"></i>
                        </a>
						@endauth
                    </div>
                </div>

                {{-- Main content --}}
                <div class="p-6 space-y-4">

                    {{-- Image and thumbnails + details block --}}
				<div class="flex flex-col lg:flex-row gap-6">
					{{-- Left side: Image and thumbnails --}}
					<div x-data="{ activeImage: '{{ asset('storage/' . $item->images->first()?->image_path) }}' }"
						 class="lg:w-1/2 flex flex-col-reverse lg:flex-row items-start gap-4">

						{{-- Thumbnails: bottom in mobile, left in desktop --}}
						<div class="flex flex-row lg:flex-col gap-3 w-full lg:w-24 justify-center lg:justify-start">
							@foreach ($item->images as $img)
								<img src="{{ asset('storage/' . $img->image_path) }}"
									 @click="activeImage = '{{ asset('storage/' . $img->image_path) }}'"
									 class="w-20 h-15 object-cover border-2 border-gray-300 hover:border-blue-500 cursor-pointer rounded"
									 alt="Thumbnail">
							@endforeach
						</div>

						{{-- Main image --}}
						<div class="w-full lg:flex-1 text-center">
							<img :src="activeImage"
								 alt="{{ $item->title }}"
								 class="h-[300px] max-w-[444px] w-full object-contain border border-gray-300 rounded shadow-sm mx-auto transition duration-300" />
						</div>
					</div>

					{{-- Right side: Details and sharing --}}
					<div class="md:w-1/2 md:self-center md:mx-auto max-w-md px-4 space-y-6 flex flex-col items-center">

						{{-- Details block --}}
						<dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5 text-sm w-full text-left">
							@php
								$details = [
									__('items.category') => $item->category->name ?? '-',
									__('items.year') => $item->year ?? '-',
									__('items.company') => $item->company ?? '-',
									__('items.serial_number') => $item->serial_number ?? '-',
									__('items.location') => $item->location ?? '-',
								];
							@endphp

							@foreach ($details as $label => $value)
								<div class="flex flex-col justify-center">
									<dt class="text-gray-700 font-semibold text-sm mb-1">{{ $label }}</dt>
									<dd class="text-gray-800">{{ $value }}</dd>
								</div>
							@endforeach

							@if ($item->link)
								<div class="flex flex-col justify-center">
									<dt class="text-gray-700 font-semibold text-sm mb-1">{{ __('items.link') }}</dt>
									<dd>
										<a href="{{ $item->link }}" class="text-blue-600 hover:underline break-all" target="_blank">Link</a>
									</dd>
								</div>
							@endif
						</dl>

						{{-- Social sharing section --}}
						<div class="flex flex-wrap gap-4 items-center justify-center md:justify-start no-print w-full">
							<span class="text-sm text-gray-600">{{ __('items.share') }}:</span>

							<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}"
							   target="_blank"
							   class="text-blue-600 hover:text-blue-800"
							   title="Facebook"
							   aria-label="Facebook">
								<i class="fab fa-facebook-square fa-xl"></i>
							</a>

							<a href="https://wa.me/?text={{ urlencode($item->title . ' ' . Request::url()) }}"
							   target="_blank"
							   class="text-green-600 hover:text-green-800 sm:hidden"
							   title="WhatsApp"
							   aria-label="WhatsApp">
								<i class="fab fa-whatsapp-square fa-xl"></i>
							</a>

							<a href="viber://forward?text={{ urlencode($item->title . ' ' . Request::url()) }}"
							   class="text-purple-600 hover:text-purple-800 sm:hidden"
							   title="Viber"
							   aria-label="Viber">
								<i class="fab fa-viber fa-xl"></i>
							</a>

							{{-- Copy to clipboard --}}
							<div x-data="{ copied: false }" class="flex items-center gap-2 hidden sm:flex">
								<button @click="navigator.clipboard.writeText('{{ Request::url() }}'); copied = true; setTimeout(() => copied = false, 2000)"
										class="text-gray-600 hover:text-gray-800"
										title="Copy link"
										aria-label="Copy link">
									<i class="fas fa-link fa-xl"></i>
								</button>
								<span x-show="copied" class="text-green-600 text-sm" x-transition>✔ Copied!</span>
							</div>
						</div>
					</div>

				</div>

                    {{-- Divider line --}}
                    <hr class="my-4">

                    {{-- Description block --}}
                    @if($item->description)
                        <div class="mt-2 text-gray-700 text-justify text-sm leading-relaxed">
                            {{ $item->description }}
                        </div>
                    @endif

                    {{-- Additional attributes --}}
                    @auth
                        @if($item->status || $item->attributes->count())
                            <hr class="my-4">
                            <h5 class="text-md font-semibold text-gray-700">{{ __('items.additional_attributes') }}</h5>
                            <ul class="list-disc list-inside text-sm text-gray-700 mt-2 leading-relaxed">
                                @foreach ($item->attributes as $attr)
                                    <li><strong>{{ $attr->attribute_name }}:</strong> {{ $attr->attribute_value }}</li>
                                @endforeach
								@if($item->status)
                                    <li><strong>{{ __('items.status') }}:</strong> {{ $item->status }}</li>
                                @endif
								@if($item->user)
									<li><strong>{{ __('items.user') }}:</strong> {{ $item->user->name }} {{ $item->user->lastname }}</li>
								@endif
                            </ul>
                        @endif
                    @else
                        <div class="p-4 mt-4 bg-blue-50 text-blue-700 border border-blue-300 rounded no-print">
                            Παρακαλώ συνδεθείτε για την προβολή περισσότερων στοιχείων.
                        </div>
                    @endauth

                    {{-- Action buttons and QR toggle --}}
					<div x-data="{ showQr: false }" x-cloak>
						<div class="flex flex-col sm:flex-row justify-center sm:items-center gap-4 mt-6 no-print">

							{{-- Back to list --}}
							<a href="{{ route('items.index') }}"
							   class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 flex items-center gap-2 justify-center">
								<i class="fas fa-list"></i> {{ __('items.back_to_list') }}
							</a>

							{{-- QR Code toggle --}}
							<button @click="showQr = !showQr"
									class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center gap-2 justify-center">
								<i class="fas fa-qrcode"></i> QR Code
							</button>

							{{-- Edit button drops below on small screens --}}
							@auth
								@if (auth()->id() === $item->user_id || auth()->user()->hasRole('admin'))
									<a href="{{ route('items.edit', $item) }}"
									   class="flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
										<i class="fas fa-edit"></i> {{ __('items.edit') }}
									</a>
								@endif
							@endauth
						</div>

						{{-- QR Code output --}}
						<div x-show="showQr" x-transition class="text-center mt-4 no-print">
							<div class="inline-block">
								{!! QrCode::size(150)->generate(Request::url()) !!}
							</div>
							<p class="text-sm text-gray-500 mt-2">
								{{ __('Registration No') }}: {{ $item->id }}
							</p>
						</div>
					</div>

                </div>
            </div>
        </div>
    </div>

    {{-- Custom styles --}}
    <style>
        [x-cloak] { display: none !important; }
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
