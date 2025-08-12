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


namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the verification email notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject(__('Επιβεβαίωση Email Λογαριασμού - Retro AXD'))
            ->greeting(__('Γεια σου :name!', ['name' => $notifiable->name]))
            ->line(__('Σε ευχαριστούμε που εγγράφηκες στην πλατφόρμα Retro AXD.'))
            ->line(__('Για να ενεργοποιήσεις τον λογαριασμό σου, παρακαλούμε κάνε κλικ στον παρακάτω σύνδεσμο:'))
            ->action(__('Επιβεβαίωση Email'), $verificationUrl)
            ->line(__('Αν δεν έκανες εσύ αυτή την εγγραφή, αγνόησε αυτό το μήνυμα.'));
    }
}
