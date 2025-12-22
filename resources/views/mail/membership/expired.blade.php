<x-mail::message>
# Hello {{ $membership->user->name }},

Your membership has expired on {{ $expiredDate }}.

<x-mail::button :url="$renewUrl">
Renew Membership
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
