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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controller for handling user offers (non-persistent).
 */
class OfferController extends Controller
{
    /**
     * Show the form for submitting an item offer.
     *
     * @return View
     */
    public function create(): View
    {
        return view('offers.create');
    }

    /**
     * Send the offer details to admin via email.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|digits:4',
            'contact' => 'required|string|max:255',
        ]);

        // Compose email content
        $data = [
            'user' => Auth::user(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'year' => $request->input('year'),
            'contact' => $request->input('contact'),
        ];

        // Send to configured admin email(s)
        Mail::send('emails.offer_notification', $data, function ($message) {
            $message->to('labschool@sch.gr') // or env('ADMIN_EMAIL')
                    ->subject('New Item Offer from Retro-AXD');
        });

        return redirect()->route('offers.create')->with('success', 'Your offer has been sent successfully!');
    }
}
