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


namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, MustVerifyEmailTrait;

    protected $fillable = [
        'name', 'lastname', 'phone', 'location', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new CustomVerifyEmail);
    }
}

