@extends('layout')
@section('content')
<script async src="https://www.google.com/recaptcha/api.js"></script>
<script>
    // Call HideInputFields on page load if alt_form_check is checked
    window.onload = function() {
        if (document.getElementById('alt_form_check').checked) {
            HideInputFields();
        }
    };
</script>
    <div class="container">
        <form method="POST" action="/thankyou" onsubmit="return DisableButtonOnSubmit()">
            @csrf
            <div class="container">
                <header class="masthead">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12 text-center">
                                <img class="img-fluid" src="{{ URL::asset('/image/header.webp') }}">
                            </div>
                        </div>
                    </div>
                </header>
                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <div class="form-row">
                    <div class="col  my-1">
                        <label for="title"> Anrede* </label>
                        <select name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                        <option value="" style="display:none" selected disabled>Bitte wählen</option>
                        <option value="Frau" {{ old('title') == "Frau" ? 'selected' : '' }} >Frau</option>
                        <option value="Herr" {{ old('title') == "Herr" ? 'selected' : '' }}>Herr</option>
                        </select>
                    </div>
                    <div class="col  my-1">
                        <label for="company"> Firma</label>
                        <input name="company" class="form-control" id="company" value="{{ old('company') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col  my-1">
                        <label for="name"> Vorname*</label>
                        <input name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="col  my-1">
                        <label for="surname"> Nachname*</label>
                        <input name="surname" class="form-control" id="surname" value="{{ old('surname') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col  my-1">
                        <label for="address"> Adresse*</label>
                        <input name="address" class="form-control" id="address" value="{{ old('address') }}" required>
                    </div>
                    <div class="col  my-1">
                        <label for="po_box"> Postfach</label>
                        <input name="po_box" class="form-control" id="po_box" value="{{ old('po_box') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col  my-1">
                        <label for="zip"> PLZ*</label>
                        <input name="zip" class="form-control" id="zip" value="{{ old('zip') }}" required>
                    </div>
                    <div class="col  my-1">
                        <label for="city"> Ort*</label>
                        <input name="city" class="form-control" id="city" value="{{ old('city') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col  my-1">
                        <label for="email"> Email*</label>
                        <input name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="col  my-1">
                        <label for="phone"> Telefon*</label>
                        <input name="phone" class="form-control" id="phone" value="{{ old('phone') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col  my-1">
                        <label for="iban"> IBAN*</label>
                        <input name="iban" class="form-control" id="iban" value="{{ old('iban') }}" required>
                    </div>
                    <div class="col  my-1">
                        <label for="bankname"> Bankname*</label>
                        <input name="bankname" class="form-control" id="bankname" value="{{ old('bankname') }}" required>
                    </div>
                </div>


                <!-- Checkbox to toggle alternative data -->
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="alt_form_check" name="alt_form_check"
                        onchange="HideInputFields()" {{ old('alt_form_check') ? 'checked' : '' }}>
                    <label class="form-check-label" for="alt_form_check">Alternative Daten </label>
                </div>


                <div class="alt_form mt-3" id="alt_form" style="display:none">
                    <div class="form-row">
                        <div class="col  my-1">
                            <label for="alt_title"> Anrede </label>
                            <select name="alt_title" class="form-control" id="alt_title" value="{{ old('alt_title') }}">
                            <option value="" style="display:none" selected readonly="readonly">Bitte wählen</option>
                            <option value="Frau" {{ old('alt_title') == "Frau" ? 'selected' : '' }} >Frau</option>
                            <option value="Herr" {{ old('alt_title') == "Herr" ? 'selected' : '' }}>Herr</option>
                            </select>
                        </div>
                        <div class="col  my-1" >

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col  my-1">
                            <label for="alt_name"> Vorname</label>
                            <input name="alt_name" class="form-control" id="alt_name" value="{{ old('alt_name') }}">
                        </div>
                        <div class="col  my-1">
                            <label for="alt_surname"> Nachname</label>
                            <input name="alt_surname" class="form-control" id="alt_surname"
                                value="{{ old('alt_surname') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col  my-1">
                            <label for="alt_address"> Adresse</label>
                            <input name="alt_address" class="form-control" id="alt_address"
                                value="{{ old('alt_address') }}">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col  my-1">
                            <label for="alt_zip"> PLZ</label>
                            <input name="alt_zip" class="form-control" id="alt_zip" value="{{ old('alt_zip') }}">
                        </div>
                        <div class="col  my-1">
                            <label for="alt_city"> Ort</label>
                            <input name="alt_city" class="form-control" id="alt_city" value="{{ old('alt_city') }}">
                        </div>
                    </div>


                </div>
                <hr>
                </hr>

                <div class="mt-2">
                    <h5><u> Wie haben Sie von uns erfahren?</u></h5>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="oral_suggestion" id="oral_suggestion"
                        value={{ old('oral_suggestion') ? 'Ja' : 'Nein' }} {{ old('oral_suggestion') == 'Nein' ? 'checked' : '' }}>
                    <label class="form-check-label" for="oral_suggestion"> Mündliche Empfehlung</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="ricardo_suggestion" id="ricardo_suggestion"
                        value={{ old('ricardo_suggestion') ? 'Ja' : 'Nein' }} {{ old('ricardo_suggestion') == 'Nein' ? 'checked' : '' }}>
                    <label class="form-check-label" for="ricardo_suggestion"> Ricardo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="socialmedia_suggestion"
                        id="socialmedia_suggestion" value={{ old('socialmedia_suggestion') ? 'Ja' : 'Nein' }} {{ old('socialmedia_suggestion') == 'Nein' ? 'checked' : '' }}>
                    <label class="form-check-label" for="socialmedia_suggestion"> Social Media</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="flyer_suggestion" id="flyer_suggestion"
                        value={{ old('flyer_suggestion') ? 'Ja' : 'Nein' }} {{ old('flyer_suggestion') == 'Nein' ? 'checked' : '' }}>
                    <label class="form-check-label" for="flyer_suggestion"> Flyer</label>
                </div>
                <hr>
                </hr>

                <div class="form-group mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" required>
                        <label class="form-check-label" for="gridCheck">
                            AGBs*
                        </label><br>
                        <span> Hiermit bestätigen Sie die Richtigkeit Ihrer Angaben und akzeptieren unsere AGB, welche Sie
                            nach
                            der Anmeldung erneut per E-Mail erhalten werden. Ihre Angaben werden zu keinem Zeitpunkt an
                            Dritte
                            weitergegeben. Ihre Mailadresse kann, bei Veränderungen unserer AGB oder Dienstleistung, zu
                            Informationszwecken verwendet werden. </span>

                    </div>
                </div>


            </div>
<!-- Google Recaptcha Widget-->
    <div class="g-recaptcha mt-4" data-sitekey={{config('services.recaptcha.key')}}></div>
            <button type="submit" id="submitBtn" class="btn btn-lg btn-primary" style="margin-top:10px;margin-bottom:10px"
                value="Eintragen">Eintragen</button>
         <div> * Felder müssen ausgefüllt werden. </div>

    </div>



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

        function DisableButtonOnSubmit() {
            // Disable the submit button
            document.getElementById('submitBtn').disabled = true;
        
            // Optionally, change the button text to indicate it's processing
            document.getElementById('submitBtn').innerText= "Wird bearbeitet...";

            // Return true to allow the form to be submitted
            return true;
        }
    </script>

    </div>

@endsection
