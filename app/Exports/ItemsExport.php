<?php
/**
 * Project: Retro AXD (Laravel 12)
 * Copyright (c) 2025 Dimitris Kanatas
 * Contact: labschool@sch.gr | https://labschool.gr | https://labschool.mysch.gr
 *
 * License: Non-Commercial, Attribution Required.
 * You may use, copy, modify, and distribute this software for NON-COMMERCIAL purposes,
 * provided you give appropriate credit to the original author:
 * Dimitris Kanatas (Labschool.gr / Labschool.mysch.gr).
 * Commercial use is prohibited without prior written permission.
 *
 * Full terms: see the LICENSE file at the repository root.
 */


namespace App\Exports;

use App\Models\Item;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected ?int $userId;
    protected ?int $categoryId;
    protected ?string $search;

    public function __construct(?int $userId = null, ?int $categoryId = null, ?string $search = null)
    {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->search = $search;
    }

    public function collection(): Collection
    {
        $query = Item::with('category', 'user')->select(
            'id', 'title', /*'description', */ 'company', 'year', 'serial_number', 'category_id', 'user_id', 'location'
        );

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('company', 'like', '%' . $this->search . '%');
            });
        }

        $items = $query->get();

        return $items->map(function ($item, $index) {
            return [
                'A/A' => $index + 1,
                'ID' => $item->id,
                'Τίτλος' => $item->title,
                //'Περιγραφή' => \Str::limit(strip_tags($item->description), 300),
                'Εταιρία' => $item->company,
                'Έτος' => $item->year,
                'Σειριακός Αριθμός' => $item->serial_number,
                'Κατηγορία' => $item->category->name ?? '-',
                'Τοποθεσία' => $item->location,
                'Καταχωριστής' => trim(($item->user->name ?? '') . ' ' . ($item->user->lastname ?? '')),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'A/A',
            'ID',
            'Τίτλος',
            //'Περιγραφή',
            'Εταιρία',
            'Έτος',
            'Σειριακός Αριθμός',
            'Κατηγορία',
            'Τοποθεσία',
            'Καταχωριστής',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]], // 1η γραμμή = κεφαλίδες
        ];
    }
}
