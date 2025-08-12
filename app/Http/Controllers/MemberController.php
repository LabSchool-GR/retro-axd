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

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

/**
 * Controller for managing user accounts (admin only).
 */
class MemberController extends Controller
{
    /**
     * Display a listing of all registered users.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::orderBy('name')->get();

        return view('members.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $member
     * @return View
     */
    public function edit(User $member): View
    {
        // Retrieve all roles for selection dropdown
        $roles = Role::all();

        return view('members.edit', compact('member', 'roles'));
    }

    /**
     * Update the specified user's information and role.
     *
     * @param Request $request
     * @param User $member
     * @return RedirectResponse
     */
    public function update(Request $request, User $member): RedirectResponse
    {
        // Validate input (email excluded)
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone'    => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:255'],
            'role'     => ['required', 'exists:roles,name'],
        ]);

        // Update member attributes
        $member->update([
            'name'     => $validated['name'],
            'lastname' => $validated['lastname'],
            'phone'    => $validated['phone'],
            'location' => $validated['location'],
        ]);

        // Sync roles
        $member->syncRoles([$validated['role']]);

        return redirect()
            ->route('admin.members.index')
            ->with('success', __('members.update_success'));
    }
}
