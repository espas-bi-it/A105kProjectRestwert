@extends('layout')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger mt-2" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
    </div>
@endif
<form method="POST" action="/customers/{{ $customer->id }}">
    @csrf
    @method('PUT')
    <div class="container mt-3">
        <div class="form-row">
            <div class="col">
                <label for="title"> Anrede* </label>
                <select name="title" class="form-control" id="title" value="{{ $customer->title }}" required @readonlyForBenutzer >
                <option value="Frau" @disabledForBenutzer {{ $customer->title == "Frau" ? 'selected' : '' }} @disabledForBenutzer >Frau</option>
                <option value="Herr" @disabledForBenutzer {{ $customer->title == "Herr" ? 'selected' : '' }}>Herr</option>
                </select>
            </div>
            <div class="col">
                <label for="company"> Firma</label>
                <input name="company" class="form-control" id="company" value="{{ $customer->company }}"  @readonlyForBenutzer >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="name"> Vorname*</label>
                <input name="name" class="form-control" value="{{ $customer->name }}" id="name" required  @readonlyForBenutzer >
            </div>
            <div class="col">
                <label for="surname"> Nachname*</label>
                <input name="surname" class="form-control" value="{{ $customer->surname }}" id="surname" required @readonlyForBenutzer >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="address"> Adresse*</label>
                <input name="address" class="form-control" value="{{ $customer->address }}" id="address" required @readonlyForBenutzer >
            </div>
            <div class="col">
                <label for="po_box"> Postfach</label>
                <input name="po_box" class="form-control" value="{{ $customer->po_box }}" id="po_box" @readonlyForBenutzer >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="zip"> PLZ*</label>
                <input name="zip" class="form-control" value="{{ $customer->zip }}" id="zip" required @readonlyForBenutzer >
            </div>
            <div class="col">
                <label for="city"> Ort*</label>
                <input name="city" class="form-control" value="{{ $customer->city }}" id="city" required @readonlyForBenutzer >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="email"> Email*</label>
                <input name="email" class="form-control" value="{{ $customer->email }}" id="email" required @readonlyForBenutzer >
            </div>
            <div class="col">
                <label for="phone"> Telefon*</label>
                <input name="phone" class="form-control" value="{{ $customer->phone }}" id="phone" required @readonlyForBenutzer >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="iban"> IBAN*</label>
                <input name="iban" class="form-control" value="{{ $customer->iban }}" id="iban" required @readonlyForBenutzer >
            </div>
            <div class="col">
                <label for="bankname"> Bankname*</label>
                <input name="bankname" class="form-control" value="{{ $customer->bankname }}" id="bankname" required @readonlyForBenutzer >
            </div>
        </div>
    </div>
    <br>

    <hr class="m-3">
    </hr>

    <div class="container" id="alt_fields">
        <div class="alt_form" id="alt_form">
            <div class="form-row">
                <div class="col">
                    <label for="alt_title"> Anrede </label>
                    <select name="alt_title" class="form-control" id="alt_title" value="{{ $customer->alt_title }}" @readonlyForBenutzer >
                    <option @disabledForBenutzer  style="display:none" value=""{{ $customer->alt_title == "" ? 'selected' : '' }}></option>
                    <option @disabledForBenutzer value="" {{ $customer->alt_title == "" ? 'selected' : '' }}></option>
                    <option @disabledForBenutzer value="Frau" {{ $customer->alt_title == "Frau" ? 'selected' : '' }}>Frau</option>
                    <option @disabledForBenutzer value="Herr" {{ $customer->alt_title == "Herr" ? 'selected' : '' }}>Herr</option>
                    </select>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="alt_name"> Vorname</label>
                    <input name="alt_name" class="form-control" value="{{ $customer->alt_name }}" id="alt_name" @readonlyForBenutzer >
                </div>
                <div class="col">
                    <label for="alt_surname"> Nachname</label>
                    <input name="alt_surname" class="form-control" value="{{ $customer->alt_surname }}" id="alt_surname" @readonlyForBenutzer >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="alt_address"> Adresse</label>
                    <input name="alt_address" class="form-control" value="{{ $customer->alt_address }}" id="alt_address" @readonlyForBenutzer >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="alt_zip"> PLZ</label>
                    <input name="alt_zip" class="form-control" value="{{ $customer->alt_zip }}" id="alt_zip" @readonlyForBenutzer >
                </div>
                <div class="col">
                    <label for="alt_city"> Ort</label>
                    <input name="alt_city" class="form-control" value="{{ $customer->alt_city }}" id="alt_city" @readonlyForBenutzer >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                </div>
                <div class="col">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                </div>
                <div class="col">
                </div>
            </div>
            <div class="mt-2">
                <label for="incorporated"> Eingetragen?</label>
                <input type="checkbox" name="incorporated" id="incorporated"
                    {{ $customer->incorporated == 0 ? '' : 'Checked' }} value="1"  @disabledForBenutzer >
            </div>
        </div>
    </div>

    @if(Auth::check() && Auth::user()->role === 'Admin' || Auth::check() && Auth::user()->role === 'TV')
    <div class="container mt-1 my-3">
        <input class="btn btn-primary" type="submit" value="Speichern"></input>
        <button class="btn"> <a type="" href="{{ URL::previous() }}">Zurück</a></button>
    </div>
    @else
    <div class="container mt-1 my-3">
        <button class="btn btn-primary"> <a href="{{ URL::previous() }}">Zurück</a></button>
    </div>
    @endif
</form>
@endsection
