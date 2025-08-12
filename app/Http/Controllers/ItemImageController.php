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

use App\Models\ItemImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ItemImageController extends Controller
{
    /**
     * Delete an image file and DB record.
     */
    public function destroy(ItemImage $image): RedirectResponse
	{
		// Delete file if it exists
		if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
			Storage::disk('public')->delete($image->image_path);
		}

		// Delete image record only
		$image->delete();

		return back()->with('success', 'Η εικόνα διαγράφηκε με επιτυχία.');
	}
}
