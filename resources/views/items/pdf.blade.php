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

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $item->title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 40px;
            color: #333;
            background-color: #fdfdfd;
        }

        .card {
            border: 2px solid #ccc;
            border-radius: 12px;
            padding: 30px;
            max-width: 750px;
            margin: 0 auto 30px auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .card-header {
            font-size: 22px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: #4b0082;
            border-bottom: 2px solid #ddd;
            padding-bottom: 8px;
        }

        .image-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .image-section img {
            max-width: 100%;
            max-height: 280px;
            object-fit: contain;
            border-radius: 6px;
            border: 1px solid #aaa;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            border: 1px solid #555;
        }

        .info-table th, .info-table td {
            text-align: left;
            padding: 8px;
            border: 1px solid #555;
            font-size: 14px;
        }

        .info-table th {
            background-color: #f0f0f0;
            width: 30%;
        }

        .qr-section {
            text-align: center;
            margin-top: 30px;
        }

        .qr-section img {
            border: 1px solid #ccc;
            padding: 4px;
            border-radius: 4px;
            width: 150px;
            height: 150px;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            color: #999;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="card">

    <!-- Title Section -->
    <div class="card-header">{{ $item->title }}</div>

    <!-- Image Thumbnail -->
    <div class="image-section">
        @if ($item->images->first())
            <img src="{{ public_path('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->title }}">
        @else
            <img src="{{ public_path('images/placeholder.png') }}" alt="No Image">
        @endif
    </div>

    <!-- Info Table with Key Fields -->
    <table class="info-table">
        <tr>
            <th>{{ __('items.year') }}</th>
            <td>{{ $item->year ?? '-' }}</td>
        </tr>
        <tr>
            <th>{{ __('items.company') }}</th>
            <td>{{ $item->company ?? '-' }}</td>
        </tr>
        <tr>
            <th>{{ __('items.serial_number') }}</th>
            <td>{{ $item->serial_number ?? '-' }}</td>
        </tr>
        <tr>
            <th>{{ __('items.category') }}</th>
            <td>{{ $item->category->name ?? '-' }}</td>
        </tr>
        <tr>
            <th>{{ __('items.collector') }}</th>
            <td>
                {{ trim(($item->user->name ?? '') . ' ' . ($item->user->lastname ?? '')) }}
            </td>
        </tr>
        <tr>
            <th>{{ __('items.location') }}</th>
            <td>{{ $item->location ?? '-' }}</td>
        </tr>
    </table>

    <!-- QR Code Section -->
    <div class="qr-section">
        @if(isset($qrSvgBase64))
            <img src="data:image/svg+xml;base64,{{ $qrSvgBase64 }}" alt="QR Code">
        @endif
        <div style="margin-top: 6px; font-size: 12px;">
            {{ __('items.registration_number') }}: {{ $item->id }}
        </div>
    </div>

</div>

<!-- Footer Section -->
<div class="footer">
    Retro AXD | Σύλλογος Τεχνολογίας Θράκης
</div>

</body>
</html>
