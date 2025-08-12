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


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'lastname' => ['required', 'string', 'max:255'],
			'phone' => ['required', 'string', 'max:20'],
			'location' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
		]);

		$user = User::create([
			'name' => $request->name,
			'lastname' => $request->lastname,
			'phone' => $request->phone,
			'location' => $request->location,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		// Εκπομπή event για αποστολή email επιβεβαίωσης
		event(new Registered($user));

		// Ανάθεση ρόλου "member"
		$user->assignRole('member');

		// Αυτόματη σύνδεση (δεν αποκτά πρόσβαση χωρίς επιβεβαίωση)
		Auth::login($user);

		return redirect()->intended('email/verify');
	}

}
