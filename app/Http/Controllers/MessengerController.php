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

use App\Mail\MessengerContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class MessengerController extends Controller
{
    /**
     * Show the contact form to the verified user.
     */
    public function create(): \Illuminate\View\View
    {
        return view('messenger.create');
    }

    /**
     * Send the message via email to all admins and cc the user.
     */
    public function send(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'subject_type' => ['required', 'in:contact_request,material_offer,catalog_editor_request'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $user = Auth::user();
        $admins = User::role('admin')->pluck('email')->toArray();

        Mail::to($admins)
            ->cc($user->email)
            ->send(new MessengerContact($user, $request->subject_type, $request->message));

        return redirect()->route('messenger.create')->with('success', __('messenger.sent_successfully'));
    }
}
