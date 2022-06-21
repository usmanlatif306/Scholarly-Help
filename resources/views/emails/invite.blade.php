@component('mail::message')

Greetings,

You are invited to join {{ settings('company_name') }} as {{ $role_name ==='Writer' ? 'an academic writer':$role_name }}
! Please click on the button below to confirm
your joining.

@component('mail::button', ['url' => route('register', ['c' => $ref_code ])])
Join Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent