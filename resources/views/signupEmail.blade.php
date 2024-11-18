


@switch($data->title)
    @case('Frau')
        Sehr geehrte Frau {{ $data->name }} {{ $data->surname }}
    @break

    @case('Herr')
        Sehr geehrter Herr {{ $data->name }} {{ $data->surname }}
    @break

    @default
        Sehr geehrte Damen und Herren
@endswitch

<p> Vielen Dank für Ihre Anmeldung. Im Anhang der Email finden Sie die besprochenen AGBs. </p>
<p> Sobald Ihr Produkt aufgeschalten wird, erhalten Sie eine Email mit den Angaben und einem Link.</p>
<p> Wir danken Ihnen für Ihr Vertrauen und hoffen, Sie bald wieder zu sehen!</p>

<p>Freundliche Grüsse </p>

<div>
    <strong>Projekt Restwert Zürich</strong><br>
    Naglerwiesenstrasse 4<br>
    8049 Zürich<br><br>
    Telefon 043 311 58 25<br>
    E-Mail zuerich@projekt-restwert.ch
</div>

<div class="col-12 text-center">
    <img src="{{ asset('image/logo.webp') }}" class="logo" alt="Logo">
</div>
