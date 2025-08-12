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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : view('auth.verify-email');
    }
}
