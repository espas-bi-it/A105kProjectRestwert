@switch($data->title)
    @case('Frau')
        {{ __('mail.greeting_f') }} {{ $data->name }} {{ $data->surname }}
    @break

    @case('Herr')
        {{ __('mail.greeting_m') }} {{ $data->name }} {{ $data->surname }}
    @break

    @default
        {{ __('mail.greeting_default') }}
@endswitch

<p> {{ __('mail.thankyou') }} </p>
<p> {{ __('mail.thankyou2') }}</p>
<p> {{ __('mail.thankyou3') }}</p>

<p>{{ __('mail.best_regards') }} </p>

<div>
    <strong>Projekt Restwert Zürich</strong><br>
    Naglerwiesenstrasse 4<br>
    8049 Zürich<br><br>
    Telefon 043 311 58 25<br>
    E-Mail zuerich@projekt-restwert.ch
</div>
