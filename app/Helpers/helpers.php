<?php

if (!function_exists('formatPhoneNumberWithSpaces')) {
    function formatPhoneNumberWithSpaces($phoneNumber)
    {
        // Remove any non-numeric characters (optional)
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Assuming phone number format is 10 digits (e.g., 0123456789)
        if (strlen($phoneNumber) == 10) {
            return preg_replace('/(\d{3})(\d{3})(\d{2})/', '$1 $2 $3 $4', $phoneNumber);
        }
        return $phoneNumber; // Return as is if it's not 10 digits long
    }
}

use Nembie\IbanRule\ValidIban;

if (!function_exists('formatIbanWithSpaces')) {

    // no need to validate. If it's in DB, it's been validated and sanitized
    function formatIbanWithSpaces($iban) {
        return implode(' ', str_split($iban, 4));  // Groups the IBAN in chunks of 4 characters
    }
}
