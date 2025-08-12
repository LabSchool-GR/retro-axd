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


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\HtmlString;
use App\Models\User;

class MessengerContact extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $subjectType;
    public string $messageContent;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $subjectType, string $messageContent)
    {
        $this->user = $user;
        $this->subjectType = $subjectType;
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject(__('messenger.subject_prefix') . ' ' . $this->translateSubject($this->subjectType))
                    ->markdown('emails.messenger.contact');
    }

    /**
     * Translate subject_type to readable label
     */
    protected function translateSubject(string $type): string
    {
        return match ($type) {
            'contact_request' => __('messenger.types.contact_request'),
            'material_offer' => __('messenger.types.material_offer'),
            'catalog_editor_request' => __('messenger.types.catalog_editor_request'),
            default => '—',
        };
    }
}
