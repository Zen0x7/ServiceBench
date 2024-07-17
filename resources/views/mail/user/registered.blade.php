<x-mail::message>
# {{ __('Hi') }} {{ $user->name }}

{{ __('Your account has been successfully added to our records.') }}

{{ __('In order to complete the registration please confirm this email:') }}

<x-mail::button :url="route('auth.verify', ['token' => $user->verification_token])">
{{ __("Yes, it's mine") }}
</x-mail::button>

{{ __("If you don't ask for this email then ignore it.") }}

{{ __('Thanks') }},<br>
{{ config('app.name') }}
</x-mail::message>
