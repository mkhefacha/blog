@component('mail::message')
<h1>Introduction</h1>

The body of your message.

-one

-tow

-three

@component('mail::button', ['url' => 'http://dev.blog/home'])
visit your compte
@endcomponent

@component('mail::panel')
    irum ipsum ok

@endcomponent
Thanks,<br>
<h1>{{ $user->name }}</h1>
@endcomponent
