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
use Illuminate\View\View;
use Illuminate\Http\Request;

/**
 * Controller for the public catalog and item detail views.
 */
class PublicCatalogController extends Controller
{
    /**
     * Display a public listing of all approved items.
     *
     * @return View
     */
    public function index(Request $request): View
	{
		$query = Item::with('category', 'user')
			->latest();

		if ($search = $request->input('search')) {
			$query->where('title', 'like', "%{$search}%")
				  ->orWhere('company', 'like', "%{$search}%");
		}

		if ($categoryId = $request->input('category')) {
			$query->where('category_id', $categoryId);
		}

		$categories = \App\Models\Category::orderBy('name')->get();
		$items = $query->paginate(20)->withQueryString();

		return view('public_catalog.index', compact('items', 'categories'));
	}


    /**
     * Display a detailed view of a single item.
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $item = Item::with(['category', 'user', 'attributes', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public_catalog.show', compact('item'));
    }
}
