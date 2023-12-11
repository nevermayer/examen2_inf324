@component('mail::message')
# Welcome to the first Newsletter

{{$mailData['nombre']}},

{{$mailData['email']}},

{{$mailData['mensaje']}},
@component('mail::button', ['url' => 'enter your desired url'])
Blog
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent