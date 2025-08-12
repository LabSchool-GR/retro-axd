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


namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\ItemAttribute;
use App\Models\ItemImage;
use App\Exports\ItemsExport;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

/**
 * Controller responsible for managing items.
 */
class ItemController extends Controller
{
    use AuthorizesRequests;

		/**
	 * Display a listing of items with optional filters and sorting.
	 *
	 * @param Request $request
	 * @return View
	 */
	public function index(Request $request): View
	{
		$query = Item::with('category', 'user');
		
		$viewMode = $request->input('view', 'grid'); // grid

		// Restrict to own items if user is editor (not admin)
		if (Auth::check() && Auth::user()->hasRole('editor') && $request->has('mine')) {
			$query->where('user_id', Auth::id());
		}

		// Keyword search
		if ($search = $request->input('search')) {
			$query->where(function ($q) use ($search) {
				$q->where('title', 'like', "%{$search}%")
				  ->orWhere('company', 'like', "%{$search}%");
			});
		}

		// Category filter
		if ($categoryId = $request->input('category')) {
			$query->where('category_id', $categoryId);
		}

		// Sorting support
		$sort = $request->input('sort', 'created_at'); // default sort
		$direction = $request->input('direction', 'desc'); // default direction

		// Allow sorting only by these fields for safety
		$allowedSorts = ['title', 'company', 'year', 'created_at'];
		if (in_array($sort, $allowedSorts) && in_array($direction, ['asc', 'desc'])) {
			$query->orderBy($sort, $direction);
		} else {
			$query->latest(); // fallback if invalid sort
		}

		$categories = Category::orderBy('name')->get();
		$items = $query->paginate(21)->withQueryString();

		return view('items.index', compact('items', 'categories', 'viewMode'));
	}


    /**
     * Show the form to create a new item.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created item and its related data (attributes, images).
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate item fields
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:items,slug|max:255',
            'category_id' => 'required|exists:categories,id',
            'company' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'year' => 'nullable|digits:4',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|max:2048', // max 2MB per image
        ]);

        // Create main item
        $item = new Item($request->only([
            'title', 'slug', 'description', 'category_id',
            'company', 'serial_number', 'link',
            'year', 'location', 'status',
        ]));
        $item->user_id = Auth::id();
        $item->save();

        // Save dynamic attributes
        $keys = $request->input('attributes.key', []);
        $values = $request->input('attributes.value', []);
        foreach ($keys as $index => $key) {
            $value = $values[$index] ?? null;
            if ($key && $value) {
                ItemAttribute::create([
                    'item_id' => $item->id,
                    'attribute_name' => $key,
                    'attribute_value' => $value,
                ]);
            }
        }

		// Save up to 3 resized images using Intervention v3
		if ($request->hasFile('images')) {
			$manager = ImageManager::withDriver(Driver::class);

			foreach ($request->file('images') as $i => $image) {
				if ($i >= 3) break;

				// Resize and compress the image
				$resizedImage = $manager->read($image)->resize(800, 600, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				})->toJpeg(75); // compress to 75% quality

				// Unique filename
				$filename = uniqid('item_', true) . '.jpg';

				// Store the image in public disk
				Storage::disk('public')->put("item-images/{$item->id}/{$filename}", (string) $resizedImage);

				// Save to DB
				ItemImage::create([
					'item_id' => $item->id,
					'image_path' => "item-images/{$item->id}/{$filename}",
					'caption' => null,
				]);
			}
		}

        return redirect()->route('items.index')->with('success', __('items.created_successfully'));
    }

    /**
     * Show the form to edit an existing item.
     * Only accessible to the item owner or admin.
     *
     * @param Item $item
     * @return View
     */
    public function edit(Item $item): View
    {
        $this->authorize('update', $item);

        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update an existing item, its attributes, and optionally add new images.
     *
     * @param Request $request
     * @param Item $item
     * @return RedirectResponse
     */
    public function update(Request $request, Item $item): RedirectResponse
    {
        $this->authorize('update', $item);

        // Validate updated fields
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:items,slug,' . $item->id,
            'category_id' => 'required|exists:categories,id',
            'company' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'year' => 'nullable|digits:4',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Update item
        $item->update($request->only([
            'title', 'slug', 'description', 'category_id',
            'company', 'serial_number', 'link',
            'year', 'location', 'status',
        ]));

        // Replace all attributes
        $item->attributes()->delete();
        $keys = $request->input('attributes.key', []);
        $values = $request->input('attributes.value', []);
        foreach ($keys as $index => $key) {
            $value = $values[$index] ?? null;
            if ($key && $value) {
                ItemAttribute::create([
                    'item_id' => $item->id,
                    'attribute_name' => $key,
                    'attribute_value' => $value,
                ]);
            }
        }

		// Add new images with resizing (existing ones remain)
		$existingCount = $item->images()->count();
		$maxImages = 3;
		$remaining = $maxImages - $existingCount;

		if ($request->hasFile('images') && $remaining > 0) {
			$manager = ImageManager::withDriver(Driver::class);
			$newImages = $request->file('images');

			foreach ($newImages as $i => $image) {
				if ($i >= $remaining) break;

				$resizedImage = $manager->read($image)->resize(800, 600, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				})->toJpeg(75); // compress to 75% quality

				$filename = uniqid('item_', true) . '.jpg';
				Storage::disk('public')->put("item-images/{$item->id}/{$filename}", (string) $resizedImage);

				ItemImage::create([
					'item_id' => $item->id,
					'image_path' => "item-images/{$item->id}/{$filename}",
					'caption' => null,
				]);
			}
		}

        return redirect()->route('items.index')->with('success', __('items.updated_successfully'));
    }

   /**
     * Delete an item and all related data (only for owner or admin).
     *
     * @param Item $item
     * @return RedirectResponse
     */
    public function destroy(Item $item): RedirectResponse
    {
        $this->authorize('delete', $item);

        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

    /**
     * Display the public detail view of an item by slug.
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $item = Item::with(['category', 'user', 'attributes', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Determine previous/next item IDs for navigation
        $previousItemId = Item::where('id', '<', $item->id)->max('id');
        $nextItemId = Item::where('id', '>', $item->id)->min('id');

        return view('items.show', compact('item', 'previousItemId', 'nextItemId'));
    }

	public function downloadPdf(Item $item)
	{
		// Generate raw SVG string (as XML)
		$svg = QrCode::format('svg')->size(150)->generate(route('items.show', $item->slug));

		// Encode the SVG as base64 for inline use in <img>
		$qrSvgBase64 = base64_encode($svg);

		return Pdf::loadView('items.pdf', compact('item', 'qrSvgBase64'))
				  ->download('item_' . $item->id . '.pdf');
	}
	
	public function exportExcel(Request $request)
	{
		$userId = null;
		if (Auth::check() && Auth::user()->hasRole('editor')) {
			$userId = Auth::id();
		}

		$categoryId = $request->input('category');
		$search = $request->input('search');

		return Excel::download(new ItemsExport($userId, $categoryId, $search), 'items_catalog.xlsx');
	}

}
