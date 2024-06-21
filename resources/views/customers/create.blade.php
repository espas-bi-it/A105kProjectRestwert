@extends('customers.layout')
@section('content')
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 text-center">
                <img class="img-fluid" src="{{URL::asset('/image/header.webp')}}">
            </div>
        </div>
    </div>
</header>
<form method="POST" action="/customers">
    @csrf
    <div class="form-row">
        <div class="col">
            <label for="title"> Anrede </label>
            <input name="title" class="form-control" id="title" value="{{old('title')}}" required>
        </div>
        <div class="col">

        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="name"> Vorname</label>
            <input name="name" class="form-control" id="name" value="{{old('name')}}" required>
        </div>
        <div class="col">
            <label for="surname"> Nachname</label>
            <input name="surname" class="form-control" id="surname" value="{{old('surname')}}" required>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="address"> Adresse</label>
            <input name="address" class="form-control" id="address" value="{{old('address')}}" required>
        </div>
        <div class="col">
            <label for="po_box"> Postfach</label>
            <input name="po_box" class="form-control" id="po_box" value="{{old('po_box')}}">
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="zip"> PLZ</label>
            <input name="zip" class="form-control" id="zip" value="{{old('zip')}}" required>
        </div>
        <div class="col">
            <label for="city"> Ort</label>
            <input name="city" class="form-control" id="city" value="{{old('city')}}" required>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="email"> Email</label>
            <input name="email" class="form-control" id="email" value="{{old('email')}}" required>
        </div>
        <div class="col">
            <label for="phone"> Telefon</label>
            <input name="phone" class="form-control" id="phone" value="{{old('phone')}}" required>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="iban"> IBAN</label>
            <input name="iban" class="form-control" id="iban" value="{{old('iban')}}" required>
        </div>
        <div class="col">
            <label for="bankname"> Bankname</label>
            <input name="bankname" class="form-control" id="bankname" value="{{old('bankname')}}" required>
        </div>
    </div>


    <!-- Checkbox to toggle alternative data -->
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="alt_form_check" name="alt_form_check"
            onchange="HideInputFields()">
        <label class="form-check-label" for="alt_form_check">Alternative Daten </label>
    </div>

    <div class="alt_form" id="alt_form" style="display:none">
        <div class="form-row">
            <div class="col">
                <label for="alt_title"> Anrede </label>
                <input name="alt_title" class="form-control" id="alt_title" value="{{old('title')}}">
            </div>
            <div class="col">

            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="alt_name"> Vorname</label>
                <input name="alt_name" class="form-control" id="alt_name" value="{{old('alt_name')}}">
            </div>
            <div class="col">
                <label for="alt_surname"> Nachname</label>
                <input name="alt_surname" class="form-control" id="alt_surname" value="{{old('alt_surname')}}">
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="alt_address"> Adresse</label>
                <input name="alt_address" class="form-control" id="alt_address" value="{{old('alt_address')}}">
            </div>
            <div class="col">
                <label for="alt_po_box"> Postfach</label>
                <input name="alt_po_box" class="form-control" id="alt_po_box" value="{{old('alt_po_box')}}">
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="alt_zip"> PLZ</label>
                <input name="alt_zip" class="form-control" id="alt_zip" value="{{old('alt_zip')}}">
            </div>
            <div class="col">
                <label for="alt_city"> Ort</label>
                <input name="alt_city" class="form-control" id="alt_city" value="{{old('alt_city')}}">
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="alt_email"> Email</label>
                <input name="alt_email" class="form-control" id="alt_email" value="{{old('alt_email')}}">
            </div>
            <div  class="col">
                <label for="alt_phone"> Telefon</label>
                <input name="alt_phone" class="form-control" id="alt_phone" value="{{old('alt_phone')}}">
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="alt_iban"> IBAN</label>
                <input name="alt_iban" class="form-control" id="alt_iban" value="{{old('alt_iban')}}">
            </div>
            <div class="col">
                <label for="alt_bankname"> Bankname</label>
                <input name="alt_bankname" class="form-control" id="alt_bankname" value="{{old('alt_bankname')}}">
            </div>
        </div>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="oral_suggestion" id="oral_suggestion" value={{ old('oral_suggestion') ? "Nein" : "Ja"}}>
        <label class="form-check-label" for="oral_suggestion"> Mündliche Empfehlung</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="ricardo_suggestion" id="ricardo_suggestion" value={{ old('ricardo_suggestion') ? "Nein" : "Ja"}}>
        <label class="form-check-label" for="ricardo_suggestion"> Ricardo</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="socialmedia_suggestion" id="socialmedia_suggestion"
            value={{ old('socialmedia_suggestion') ? "Nein" : "Ja"}}>
        <label class="form-check-label" for="socialmedia_suggestion"> Social Media</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="flyer_suggestion" id="flyer_suggestion" value={{ old('flyer_suggestion') ? "Nein" : "Ja"}}>
        <label class="form-check-label" for="flyer_suggestion"> Flyer</label>
    </div>
    <input type="submit" class="btn btn-lg btn-primary" style="margin-top:10px;margin-bottom:10px" value="Eintragen">
</form>

<script>
    function HideInputFields() {
        var checkBox = document.getElementById("alt_form_check");
        var text = document.getElementById("alt_form");
        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection