<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if there's a language in the session
        if (Session::has('locale')) {
            // Set the locale from session
            App::setLocale(Session::get('locale'));
        } else {
            // If no language in session, auto-detect the browser's preferred language
            $browserLanguage = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2); // Get the first two characters (en, de, fr, etc.)
            $availableLanguages = ['en', 'de', 'fr']; // List of available languages

            // If the detected browser language is available, set it as the app's locale
            if (in_array($browserLanguage, $availableLanguages)) {
                App::setLocale($browserLanguage);
                Session::put('locale', $browserLanguage); // Store the language in the session
            }
        }

        return $next($request);
    }
}
