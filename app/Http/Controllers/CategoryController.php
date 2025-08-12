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

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Controller responsible for managing categories.
 */
class CategoryController extends Controller
{
    /**
	 * Display a listing of all categories with sorting and pagination.
	 *
	 * @param Request $request
	 * @return View
	 */
	public function index(Request $request): View
	{
		$sortField = $request->get('sort', 'name');
		$sortDirection = $request->get('direction', 'asc');

		// Prevent invalid sort field or direction
		if (!in_array($sortField, ['name', 'slug'])) {
			$sortField = 'name';
		}

		if (!in_array($sortDirection, ['asc', 'desc'])) {
			$sortDirection = 'asc';
		}

		$categories = Category::orderBy($sortField, $sortDirection)
			->paginate(12)
			->withQueryString();

		return view('categories.index', compact('categories'));
	}

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
            'description' => 'nullable|string',
            'slug' => 'required|string|unique:categories,slug|max:255',
        ]);

        Category::create($request->only('name', 'description', 'slug'));

        return redirect()->route('admin.categories.index')->with('success', __('Κατηγορία δημιουργήθηκε επιτυχώς.'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
        ]);

        $category->update($request->only('name', 'description', 'slug'));

        return redirect()->route('admin.categories.index')->with('success', __('Κατηγορία ενημερώθηκε επιτυχώς.'));
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', __('Κατηγορία διαγράφηκε επιτυχώς.'));
    }
}
