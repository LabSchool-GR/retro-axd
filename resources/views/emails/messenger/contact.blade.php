{{-- 
  Project: Retro AXD (Laravel 12)
  Copyright (c) 2025 Dimitris Kanatas
  Contact: labschool@sch.gr | https://labschool.gr | https://labschool.mysch.gr

  License: Non-Commercial, Attribution Required.
  You may use, copy, modify, and distribute this software for NON-COMMERCIAL purposes,
  provided you give appropriate credit to the original author:
  Dimitris Kanatas (Labschool.gr / Labschool.mysch.gr).
  Commercial use is prohibited without prior written permission.

  Full terms: see the LICENSE file at the repository root.
--}}

<x-mail::message>
# {{ __('messenger.subject_prefix') }}: {{ __('messenger.types.' . $subjectType) }}

<x-mail::panel>
**{{ __('messenger.name') }}:** {{ $user->name }} {{ $user->lastname }}  
**Email:** {{ $user->email }}  
**{{ __('messenger.phone') }}:** {{ $user->phone }}  
**{{ __('messenger.location') }}:** {{ $user->location }}
</x-mail::panel>

**{{ __('messenger.message') }}:**

<x-mail::panel>
{!! nl2br(e($messageContent)) !!}
</x-mail::panel>

{{ __('messenger.thank_you') }},  
**Retro Guardians AXD**
</x-mail::message>
