@extends('layout')
@section('content')
    <div class="container">
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
                        <label for="title"> Anrede </label>
                        <input name="title" class="form-control" value="{{ $customer->title }}" id="title"
                            value="{{ old('title') }}" required>
                    </div>
                    <div class="col">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="name"> Vorname</label>
                        <input name="name" class="form-control" value="{{ $customer->name }}" id="name"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="col">
                        <label for="surname"> Nachname</label>
                        <input name="surname" class="form-control" value="{{ $customer->surname }}" id="surname"
                            value="{{ old('surname') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="address"> Adresse</label>
                        <input name="address" class="form-control" value="{{ $customer->address }}" id="address"
                            value="{{ old('address') }}" required>
                    </div>
                    <div class="col">
                        <label for="po_box"> Postfach</label>
                        <input name="po_box" class="form-control" value="{{ $customer->po_box }}" id="po_box"
                            value="{{ old('po_box') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="zip"> PLZ</label>
                        <input name="zip" class="form-control" value="{{ $customer->zip }}" id="zip"
                            value="{{ old('zip') }}" required>
                    </div>
                    <div class="col">
                        <label for="city"> Ort</label>
                        <input name="city" class="form-control" value="{{ $customer->city }}" id="city"
                            value="{{ old('city') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="email"> Email</label>
                        <input name="email" class="form-control" value="{{ $customer->email }}" id="email"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="col">
                        <label for="phone"> Telefon</label>
                        <input name="phone" class="form-control" value="{{ $customer->phone }}" id="phone"
                            value="{{ old('phone') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="iban"> IBAN</label>
                        <input name="iban" class="form-control" value="{{ $customer->iban }}" id="iban"
                            value="{{ old('iban') }}" required>
                    </div>
                    <div class="col">
                        <label for="bankname"> Bankname</label>
                        <input name="bankname" class="form-control" value="{{ $customer->bankname }}" id="bankname"
                            value="{{ old('bankname') }}" required>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
                <h2> Alternative Daten</h2>
                <div class="alt_form" id="alt_form">
                    <div class="form-row">
                        <div class="col">
                            <label for="alt_title"> Anrede </label>
                            <input name="alt_title" class="form-control" value="{{ $customer->alt_title }}" id="alt_title"
                                value="{{ old('title') }}">
                        </div>
                        <div class="col">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="alt_name"> Vorname</label>
                            <input name="alt_name" class="form-control" value="{{ $customer->alt_name }}"
                                id="alt_name" value="{{ old('alt_name') }}">
                        </div>
                        <div class="col">
                            <label for="alt_surname"> Nachname</label>
                            <input name="alt_surname" class="form-control" value="{{ $customer->alt_surname }}"
                                id="alt_surname" value="{{ old('alt_surname') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="alt_address"> Adresse</label>
                            <input name="alt_address" class="form-control" value="{{ $customer->alt_address }}"
                                id="alt_address" value="{{ old('alt_address') }}">
                        </div>
                        <div class="col">
                            <label for="alt_po_box"> Postfach</label>
                            <input name="alt_po_box" class="form-control" value="{{ $customer->alt_po_box }}"
                                id="alt_po_box" value="{{ old('alt_po_box') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="alt_zip"> PLZ</label>
                            <input name="alt_zip" class="form-control" value="{{ $customer->alt_zip }}" id="alt_zip"
                                value="{{ old('alt_zip') }}">
                        </div>
                        <div class="col">
                            <label for="alt_city"> Ort</label>
                            <input name="alt_city" class="form-control" value="{{ $customer->alt_city }}"
                                id="alt_city" value="{{ old('alt_city') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="alt_email"> Email</label>
                            <input name="alt_email" class="form-control" value="{{ $customer->alt_email }}"
                                id="alt_email" value="{{ old('alt_email') }}">
                        </div>
                        <div class="col">
                            <label for="alt_phone"> Telefon</label>
                            <input name="alt_phone" class="form-control" value="{{ $customer->alt_phone }}"
                                id="alt_phone" value="{{ old('alt_phone') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="alt_iban"> IBAN</label>
                            <input name="alt_iban" class="form-control" value="{{ $customer->alt_iban }}"
                                id="alt_iban" value="{{ old('alt_iban') }}">
                        </div>
                        <div class="col">
                            <label for="alt_bankname"> Bankname</label>
                            <input name="alt_bankname" class="form-control" value="{{ $customer->alt_bankname }}"
                                id="alt_bankname" value="{{ old('alt_bankname') }}">
                        </div>
                    </div>

                    <div class="mt-2">
                        <label for="incorporated"> Eingetragen?</label>
                        <input type="checkbox" name="incorporated" id="incorporated"
                            {{ $customer->incorporated == 0 ? '' : 'Checked' }} value="1">
                    </div>
                </div>
            </div>

            <div class="container mt-1 my-3">
                <input class="btn" type="submit" value="Speichern"></input>
                <button class="btn"> <a type="" href="{{ URL::previous() }}">Zurück</a></button>
            </div>
        </form>



    </div>
@endsection
