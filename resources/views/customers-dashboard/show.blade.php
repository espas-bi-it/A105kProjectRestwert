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
                <!-- Anrede -->
                <label for="title"> {{ __('fields.title') }}* </label>
                <select name="title" class="form-control" id="title" value="{{ $customer->title }}" required @readonlyForBenutzer >
                <option value="Frau" @disabledForBenutzer {{ $customer->title == "Frau" ? 'selected' : '' }} @disabledForBenutzer >{{ __('fields.female') }}</option>
                <option value="Herr" @disabledForBenutzer {{ $customer->title == "Herr" ? 'selected' : '' }}>{{ __('fields.male') }}</option>
                </select>
            </div>
            <div class="col">
                <!-- Firma -->
                <label for="company"> {{ __('fields.company') }}</label>
                <input name="company" class="form-control" id="company" value="{{ $customer->company }}"  @readonlyForBenutzer >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <!-- Vorname -->
                <label for="name"> {{ __('fields.name') }}*</label>
                <input name="name" class="form-control" value="{{ $customer->name }}" id="name" required  @readonlyForBenutzer >
            </div>
            <div class="col">
                <!-- Nachname -->
                <label for="surname"> {{ __('fields.surname') }}*</label>
                <input name="surname" class="form-control" value="{{ $customer->surname }}" id="surname" required @readonlyForBenutzer >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <!-- Adresse -->
                <label for="address"> {{ __('fields.address') }}*</label>
                <input name="address" class="form-control" value="{{ $customer->address }}" id="address" required @readonlyForBenutzer >
            </div>
            <div class="col">
                <!-- Postfach -->
                <label for="po_box"> {{ __('fields.po_box') }}</label>
                <input name="po_box" class="form-control" value="{{ $customer->po_box }}" id="po_box" @readonlyForBenutzer >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <!-- PLZ -->
                <label for="zip"> {{ __('fields.zip') }}*</label>
                <input name="zip" class="form-control" value="{{ $customer->zip }}" id="zip" required @readonlyForBenutzer >
            </div>
            <div class="col">
                <!-- Ort -->
                <label for="city"> {{ __('fields.city') }}*</label>
                <input name="city" class="form-control" value="{{ $customer->city }}" id="city" required @readonlyForBenutzer >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <!-- Email -->
                <label for="email"> {{ __('fields.email') }}*</label>
                <input name="email" class="form-control" value="{{ $customer->email }}" id="email" required @readonlyForBenutzer >
            </div>
            <div class="col">
                <!-- Telefon -->
                <label for="phone"> {{ __('fields.phone') }}*</label>
                <input name="phone" class="form-control" value="{{ $customer->phone }}" id="phone" required @readonlyForBenutzer >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <!-- IBAN -->
                <label for="iban"> {{ __('fields.iban') }}*</label>
                <input name="iban" class="form-control" value="{{ $customer->iban }}" id="iban" required @readonlyForBenutzer >
            </div>
            <div class="col">
                <!-- Bankname -->
                <label for="bankname"> {{ __('fields.bankname') }}*</label>
                <input name="bankname" class="form-control" value="{{ $customer->bankname }}" id="bankname" required @readonlyForBenutzer >
            </div>
        </div>
    </div>
    <br>

    <hr class="m-3"></hr>

    <div class="container" id="alt_fields">
        <div class="alt_form" id="alt_form">
            <div class="form-row">
                <div class="col">
                    <!-- Alternative Anrede -->
                    <label for="alt_title"> {{ __('fields.title') }} </label>
                    <select name="alt_title" class="form-control" id="alt_title" value="{{ $customer->alt_title }}" @readonlyForBenutzer >
                    <option @disabledForBenutzer  style="display:none" value=""{{ $customer->alt_title == "" ? 'selected' : '' }}></option>
                    <option @disabledForBenutzer value="" {{ $customer->alt_title == "" ? 'selected' : '' }}></option>
                    <option @disabledForBenutzer value="Frau" {{ $customer->alt_title == "Frau" ? 'selected' : '' }}>{{ __('fields.female') }}</option>
                    <option @disabledForBenutzer value="Herr" {{ $customer->alt_title == "Herr" ? 'selected' : '' }}>{{ __('fields.male') }}</option>
                    </select>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <!-- Alternativer Vorname -->
                    <label for="alt_name"> {{ __('fields.name') }}</label>
                    <input name="alt_name" class="form-control" value="{{ $customer->alt_name }}" id="alt_name" @readonlyForBenutzer >
                </div>
                <div class="col">
                    <!-- Alternativer Nachname -->
                    <label for="alt_surname"> {{ __('fields.surname') }}</label>
                    <input name="alt_surname" class="form-control" value="{{ $customer->alt_surname }}" id="alt_surname" @readonlyForBenutzer >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <!-- Alternative Adresse -->
                    <label for="alt_address"> {{ __('fields.address') }}</label>
                    <input name="alt_address" class="form-control" value="{{ $customer->alt_address }}" id="alt_address" @readonlyForBenutzer >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <!-- Alternative PLZ -->
                    <label for="alt_zip"> {{ __('fields.zip') }}</label>
                    <input name="alt_zip" class="form-control" value="{{ $customer->alt_zip }}" id="alt_zip" @readonlyForBenutzer >
                </div>
                <div class="col">
                    <!-- Alternativer Ort -->
                    <label for="alt_city"> {{ __('fields.city') }}</label>
                    <input name="alt_city" class="form-control" value="{{ $customer->alt_city }}" id="alt_city" @readonlyForBenutzer >
                </div>
            </div>
            <div class="mt-2">
                 <!-- Eingetragen Checkbox -->
                <label for="incorporated"> {{ __('fields.incorporated') }}?</label>
                <input type="checkbox" name="incorporated" id="incorporated"
                    {{ $customer->incorporated == 0 ? '' : 'Checked' }} value="1"  @disabledForBenutzer >
            </div>
        </div>
    </div>
    @if(Auth::check() && Auth::user()->role === 'Admin' || Auth::check() && Auth::user()->role === 'TV')
    <div class="container mt-1 my-3">
        <!-- Speichern Button -->
        <input class="btn btn-primary" type="submit" value="{{ __('buttons.save') }}"></input>
        <button class="btn"> <a type="" href="{{ URL::previous() }}">{{ __('buttons.back') }}</a></button>
    </div>
    @else
    <div class="container mt-1 my-3">
        <!-- Zurück Button -->
        <button class="btn btn-primary"> <a href="{{ URL::previous() }}">{{ __('buttons.back') }}</a></button>
    </div>
    @endif
</form>
@endsection
