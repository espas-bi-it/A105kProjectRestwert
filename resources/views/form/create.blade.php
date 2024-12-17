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
        @include('components.locale-switcher')
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
                         <!-- Anrede -->
                        <label for="title">  {{ __('fields.title') }}* </label>
                        <select name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                        <option value="" style="display:none" selected disabled>{{ __('fields.selection') }}</option>
                        <option value="Frau" {{ old('title') == "Frau" ? 'selected' : '' }} >Frau</option>
                        <option value="Herr" {{ old('title') == "Herr" ? 'selected' : '' }}>Herr</option>
                        </select>
                    </div>
                    <div class="col  my-1">
                         <!-- Firma -->
                        <label for="company">{{ __('fields.company') }}</label>
                        <input name="company" class="form-control" id="company" value="{{ old('company') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col  my-1">
                         <!-- Vorname -->
                        <label for="name"> {{ __('fields.name') }}*</label>
                        <input name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="col  my-1">
                         <!-- Nachname -->
                        <label for="surname"> {{ __('fields.surname') }}*</label>
                        <input name="surname" class="form-control" id="surname" value="{{ old('surname') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col  my-1">
                         <!-- Adresse -->
                        <label for="address"> {{ __('fields.address') }}*</label>
                        <input name="address" class="form-control" id="address" value="{{ old('address') }}" required>
                    </div>
                    <div class="col  my-1">
                         <!-- Postfach -->
                        <label for="po_box"> {{ __('fields.po_box') }}</label>
                        <input name="po_box" class="form-control" id="po_box" value="{{ old('po_box') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col  my-1">
                         <!-- PLZ -->
                        <label for="zip"> {{ __('fields.zip') }}*</label>
                        <input name="zip" class="form-control" id="zip" value="{{ old('zip') }}" required>
                    </div>
                    <div class="col  my-1">
                         <!-- Ort -->
                        <label for="city"> {{ __('fields.city') }}*</label>
                        <input name="city" class="form-control" id="city" value="{{ old('city') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col  my-1">
                         <!-- Email -->
                        <label for="email"> {{ __('fields.email') }}*</label>
                        <input name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="col  my-1">
                         <!-- Telefon -->
                        <label for="phone"> {{ __('fields.phone') }}*</label>
                        <input name="phone" class="form-control" id="phone" value="{{ old('phone') }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col  my-1">
                         <!-- IBAN -->
                        <label for="iban"> {{ __('fields.iban') }}*</label>
                        <input name="iban" class="form-control" id="iban" value="{{ old('iban') }}" required>
                    </div>
                    <div class="col  my-1">
                         <!-- Bankname -->
                        <label for="bankname"> {{ __('fields.bankname') }}*</label>
                        <input name="bankname" class="form-control" id="bankname" value="{{ old('bankname') }}" required>
                    </div>
                </div>


                <!-- Checkbox to toggle alternative data -->
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="alt_form_check" name="alt_form_check"
                        onchange="HideInputFields()" {{ old('alt_form_check') ? 'checked' : '' }}>
                    <label class="form-check-label" for="alt_form_check">{{ __('fields.alternative_input') }} </label>
                </div>


                <div class="alt_form mt-3" id="alt_form" style="display:none">
                    <div class="form-row">
                        <div class="col  my-1">
                            <!-- Alternative Anrede -->
                            <label for="alt_title"> {{ __('fields.title') }} </label>
                            <select name="alt_title" class="form-control" id="alt_title" value="{{ old('alt_title') }}">
                            <option value="" style="display:none" selected readonly="readonly">{{ __('fields.selection') }}</option>
                            <option value="Frau" {{ old('alt_title') == "Frau" ? 'selected' : '' }} >Frau</option>
                            <option value="Herr" {{ old('alt_title') == "Herr" ? 'selected' : '' }}>Herr</option>
                            </select>
                        </div>
                        <div class="col  my-1">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col  my-1">
                            <!-- Alternativer Vorname -->
                            <label for="alt_name"> {{ __('fields.name') }}</label>
                            <input name="alt_name" class="form-control" id="alt_name" value="{{ old('alt_name') }}">
                        </div>
                        <div class="col  my-1">
                            <!-- Alternativer Nachname -->
                            <label for="alt_surname"> {{ __('fields.surname') }}</label>
                            <input name="alt_surname" class="form-control" id="alt_surname"
                                value="{{ old('alt_surname') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col  my-1">
                            <!-- Alternative Adresse -->
                            <label for="alt_address"> {{ __('fields.address') }}</label>
                            <input name="alt_address" class="form-control" id="alt_address"
                                value="{{ old('alt_address') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col  my-1">
                            <!-- Alternative PLZ -->
                            <label for="alt_zip"> {{ __('fields.zip') }}</label>
                            <input name="alt_zip" class="form-control" id="alt_zip" value="{{ old('alt_zip') }}">
                        </div>
                        <div class="col  my-1">
                            <!-- Alternativer Ort -->
                            <label for="alt_city"> {{ __('fields.city') }}</label>
                            <input name="alt_city" class="form-control" id="alt_city" value="{{ old('alt_city') }}">
                        </div>
                    </div>
                </div>

                <hr class="mt-3">
                </hr>

                <div class="mt-2">
                    <!-- Umfrage -->
                    <h5><u>{{ __('fields.suggestion_text') }}</u></h5>
                </div>
                <div class="form-check">
                    <!-- Mündliche Empfehlung -->
                    <input class="form-check-input" type="checkbox" name="oral_suggestion" id="oral_suggestion"
                        value={{ old('oral_suggestion') ? 'Ja' : 'Nein' }} {{ old('oral_suggestion') == 'Nein' ? 'checked' : '' }}>
                    <label class="form-check-label" for="oral_suggestion"> {{ __('fields.oral_suggestion') }}</label>
                </div>
                <div class="form-check">
                    <!-- Ricardo -->
                    <input class="form-check-input" type="checkbox" name="ricardo_suggestion" id="ricardo_suggestion"
                        value={{ old('ricardo_suggestion') ? 'Ja' : 'Nein' }} {{ old('ricardo_suggestion') == 'Nein' ? 'checked' : '' }}>
                    <label class="form-check-label" for="ricardo_suggestion"> {{ __('fields.ricardo_suggestion') }}</label>
                </div>
                <div class="form-check">
                    <!-- Social Media -->
                    <input class="form-check-input" type="checkbox" name="socialmedia_suggestion"
                        id="socialmedia_suggestion" value={{ old('socialmedia_suggestion') ? 'Ja' : 'Nein' }} {{ old('socialmedia_suggestion') == 'Nein' ? 'checked' : '' }}>
                    <label class="form-check-label" for="socialmedia_suggestion"> {{ __('fields.socialmedia_suggestion') }}</label>
                </div>
                <div class="form-check">
                    <!-- Flyer -->
                    <input class="form-check-input" type="checkbox" name="flyer_suggestion" id="flyer_suggestion"
                        value={{ old('flyer_suggestion') ? 'Ja' : 'Nein' }} {{ old('flyer_suggestion') == 'Nein' ? 'checked' : '' }}>
                    <label class="form-check-label" for="flyer_suggestion"> {{ __('fields.flyer_suggestion') }}</label>
                </div>

                <hr> </hr>

                <div class="form-group mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" required>
                        <label class="form-check-label" for="gridCheck">
                        <!-- AGBs und Text -->
                            {{ __('fields.tos') }}*
                        </label><br>
                        <span> {{ __('fields.tos_text') }} </span>
                    </div>
                </div>
            </div>
            <!-- Google Recaptcha Widget-->
            <div class="g-recaptcha mt-4" data-sitekey={{config('services.recaptcha.key')}}></div>
                    <button type="submit" id="submitBtn" class="btn btn-lg btn-primary" style="margin-top:10px;margin-bottom:10px"
                        value="Eintragen">{{ __('fields.submit') }}</button>
                 <div> {{ __('fields.field_required') }} </div>
        </form>
        <script>
            // Hide the alternative input fields if checkbox isn't checked
            function HideInputFields() {
                var checkBox = document.getElementById("alt_form_check");
                var text = document.getElementById("alt_form");
                if (checkBox.checked == true) {
                    text.style.display = "block";
                } else {
                    text.style.display = "none";
                }
            }
            // Only allow button to be pressed once, to prevent spam submissions.
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
