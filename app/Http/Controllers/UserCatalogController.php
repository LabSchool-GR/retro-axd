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
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Controller for showing the current user's own items.
 */
class UserCatalogController extends Controller
{
    /**
     * Display a list of items created by the current user.
     *
     * @return View
     */
    public function index(): View
    {
        $items = Item::with('category')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user_catalog.index', compact('items'));
    }
}
