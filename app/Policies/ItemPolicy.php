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


namespace App\Policies;

use App\Models\Item;
use App\Models\User;

class ItemPolicy
{
    /**
     * Allow all authenticated users to view items.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Allow all authenticated users to view a specific item.
     */
    public function view(User $user, Item $item): bool
    {
        return true;
    }

    /**
     * Allow admins and editors to create items.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    /**
     * Allow only the creator or an admin to update the item.
     */
    public function update(User $user, Item $item): bool
    {
        return $user->hasRole('admin') || $user->id === $item->user_id;
    }

    /**
     * Allow only the creator or an admin to delete the item.
     */
    public function delete(User $user, Item $item): bool
    {
        return $user->hasRole('admin') || $user->id === $item->user_id;
    }

    /**
     * Disallow restore operation (optional).
     */
    public function restore(User $user, Item $item): bool
    {
        return false;
    }

    /**
     * Disallow force delete (optional).
     */
    public function forceDelete(User $user, Item $item): bool
    {
        return false;
    }
}
