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
                <select name="title" class="form-control" id="title" value="{{ $customer->title }}" required @readonlyForBasicPermission >
                <option value="Frau" @disabledForBasicPermission {{ $customer->title == "Frau" ? 'selected' : '' }} @disabledForBasicPermission >{{ __('fields.female') }}</option>
                <option value="Herr" @disabledForBasicPermission {{ $customer->title == "Herr" ? 'selected' : '' }}>{{ __('fields.male') }}</option>
                </select>
            </div>
            <div class="col">
                <!-- Firma -->
                <label for="company"> {{ __('fields.company') }}</label>
                <input maxlength="50" name="company" class="form-control" id="company" value="{{ $customer->company }}"  @readonlyForBasicPermission >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <!-- Vorname -->
                <label for="name"> {{ __('fields.name') }}*</label>
                <input maxlength="50" name="name" class="form-control" value="{{ $customer->name }}" id="name" required  @readonlyForBasicPermission >
            </div>
            <div class="col">
                <!-- Nachname -->
                <label for="surname"> {{ __('fields.surname') }}*</label>
                <input maxlength="50" name="surname" class="form-control" value="{{ $customer->surname }}" id="surname" required @readonlyForBasicPermission >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <!-- Adresse -->
                <label for="address"> {{ __('fields.address') }}*</label>
                <input maxlength="50" name="address" class="form-control" value="{{ $customer->address }}" id="address" required @readonlyForBasicPermission >
            </div>
            <div class="col">
                <!-- Postfach -->
                <label for="po_box"> {{ __('fields.po_box') }}</label>
                <input maxlength="50" name="po_box" class="form-control" value="{{ $customer->po_box }}" id="po_box" @readonlyForBasicPermission >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <!-- PLZ -->
                <label for="zip"> {{ __('fields.zip') }}*</label>
                <input maxlength="10" name="zip" class="form-control" value="{{ $customer->zip }}" id="zip" required @readonlyForBasicPermission >
            </div>
            <div class="col">
                <!-- Ort -->
                <label for="city"> {{ __('fields.city') }}*</label>
                <input maxlength="50" name="city" class="form-control" value="{{ $customer->city }}" id="city" required @readonlyForBasicPermission >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <!-- Email -->
                <label for="email"> {{ __('fields.email') }}*</label>
                <input maxlength="50" name="email" class="form-control" value="{{ $customer->email }}" id="email" required @readonlyForBasicPermission >
            </div>
            <div class="col">
                <!-- Telefon -->
                <label for="phone"> {{ __('fields.phone') }}*</label>
                <input maxlength="20" name="phone" class="form-control" value="{{ $customer->phone }}" id="phone" required @readonlyForBasicPermission >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <!-- IBAN -->
                <label for="iban"> {{ __('fields.iban') }}*</label>
                <input maxlength="34" name="iban" class="form-control" value="{{ $customer->iban }}" id="iban" required @readonlyForBasicPermission >
            </div>
            <div class="col">
                <!-- Bankname -->
                <label for="bankname"> {{ __('fields.bankname') }}*</label>
                <input maxlength="50" name="bankname" class="form-control" value="{{ $customer->bankname }}" id="bankname" required @readonlyForBasicPermission >
            </div>
        </div>
    </div>
    <br>

    <hr class="m-3">

    <div class="container" id="alt_fields">
        <div class="alt_form" id="alt_form">
            <div class="form-row">
                <div class="col">
                    <!-- Alternative Anrede -->
                    <label for="alt_title"> {{ __('fields.title') }} </label>
                    <select name="alt_title" class="form-control" id="alt_title" value="{{ $customer->alt_title }}" @readonlyForBasicPermission >
                    <option @disabledForBasicPermission  style="display:none" value=""{{ $customer->alt_title == "" ? 'selected' : '' }}></option>
                    <option @disabledForBasicPermission value="" {{ $customer->alt_title == "" ? 'selected' : '' }}></option>
                    <option @disabledForBasicPermission value="Frau" {{ $customer->alt_title == "Frau" ? 'selected' : '' }}>{{ __('fields.female') }}</option>
                    <option @disabledForBasicPermission value="Herr" {{ $customer->alt_title == "Herr" ? 'selected' : '' }}>{{ __('fields.male') }}</option>
                    </select>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <!-- Alternativer Vorname -->
                    <label for="alt_name"> {{ __('fields.name') }}</label>
                    <input maxlength="50" name="alt_name" class="form-control" value="{{ $customer->alt_name }}" id="alt_name" @readonlyForBasicPermission >
                </div>
                <div class="col">
                    <!-- Alternativer Nachname -->
                    <label for="alt_surname"> {{ __('fields.surname') }}</label>
                    <input maxlength="50" name="alt_surname" class="form-control" value="{{ $customer->alt_surname }}" id="alt_surname" @readonlyForBasicPermission >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <!-- Alternative Adresse -->
                    <label for="alt_address"> {{ __('fields.address') }}</label>
                    <input maxlength="50" name="alt_address" class="form-control" value="{{ $customer->alt_address }}" id="alt_address" @readonlyForBasicPermission >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <!-- Alternative PLZ -->
                    <label for="alt_zip"> {{ __('fields.zip') }}</label>
                    <input maxlength="10" name="alt_zip" class="form-control" value="{{ $customer->alt_zip }}" id="alt_zip" @readonlyForBasicPermission >
                </div>
                <div class="col">
                    <!-- Alternativer Ort -->
                    <label for="alt_city"> {{ __('fields.city') }}</label>
                    <input maxlength="50" name="alt_city" class="form-control" value="{{ $customer->alt_city }}" id="alt_city" @readonlyForBasicPermission >
                </div>
            </div>
            <div class="mt-2">
                 <!-- Eingetragen Checkbox -->
                <label for="incorporated"> {{ __('fields.incorporated') }}?</label>
                <input type="checkbox" name="incorporated" id="incorporated"
                    {{ $customer->incorporated == 0 ? '' : 'Checked' }} value="1"  @disabledForBasicPermission >
            </div>
        </div>
    </div>
    @if(Auth::user()->hasAdvancedPermissions())
    <div class="container mt-1 my-3">
        <!-- Speichern Button -->
        <input class="btn btn-primary" type="submit" value="{{ __('buttons.save') }}">
        <a href="{{ URL::previous() }}" class="btn">{{ __('buttons.back') }}</a>
    </div>
    @else
    <div class="container mt-1 my-3">
        <!-- Zurück Button -->
        <a href="{{ URL::previous() }}" class="btn">{{ __('buttons.back') }}</a>
    </div>
    @endif
</form>
@endsection
