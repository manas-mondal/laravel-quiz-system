<x-mail::message>
    # Hello {{ $user->name }},

    Please verify your email address by clicking the button below.

    <x-mail::button :url="route('verify.user', ['token' => $user->verification_token])">
        Verify Email Address
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
