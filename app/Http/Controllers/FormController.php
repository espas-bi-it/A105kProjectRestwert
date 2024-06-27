<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;


class FormController extends Controller
{

     public function index(Request $request)
     {
        return view('thankyou');
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = new Customer();

        $validatedData = $request->validate([
            'title' => 'required|min:2',
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'po_box' => '',
            'zip' => 'required',
            'city' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'iban' => 'required',
            'bankname' => 'required',
            'alt_title' => '',
            'alt_name' => '',
            'alt_surname' => '',
            'alt_address' => '',
            'alt_po_box' => '',
            'alt_zip' => '',
            'alt_city' => '',
            'alt_email' => '',
            'alt_phone' => '',
            'alt_iban' => '',
            'alt_bankname' => '',
            'oral_suggestion' => '',
            'ricardo_suggestion' => '',
            'socialmedia_suggestion' => '',
            'flyer_suggestion' => '',
            'incorporated' => ''
        ]);

        $customer = new Customer();

        $customer->title = $validatedData['title'];
        $customer->name = $validatedData['name'];
        $customer->surname = $validatedData['surname'];
        $customer->address = $validatedData['address'];
        $customer->po_box = $validatedData['po_box'];
        $customer->zip = $validatedData['zip'];
        $customer->city = $validatedData['city'];
        $customer->email = $validatedData['email'];
        $customer->phone = $validatedData['phone'];
        $customer->iban = $validatedData['iban'];
        $customer->bankname = $validatedData['bankname'];

        $customer->alt_title = $validatedData['alt_title'];
        $customer->alt_name = $validatedData['alt_name'];
        $customer->alt_surname = $validatedData['alt_surname'];
        $customer->alt_address = $validatedData['alt_address'];
        $customer->alt_po_box = $validatedData['alt_po_box'];
        $customer->alt_zip = $validatedData['alt_zip'];
        $customer->alt_city = $validatedData['alt_city'];
        $customer->alt_email = $validatedData['alt_email'];
        $customer->alt_phone = $validatedData['alt_phone'];
        $customer->alt_iban = $validatedData['alt_iban'];
        $customer->alt_bankname = $validatedData['alt_bankname'];

        if (isset($validatedData['oral_suggestion'])) {
            $customer->oral_suggestion = "Ja";
        } else {
            $customer->oral_suggestion = "Nein";
        }

        if (isset($validatedData['ricardo_suggestion'])) {
            $customer->ricardo_suggestion = "Ja";
        } else {
            $customer->ricardo_suggestion = "Nein";
        }

        if (isset($validatedData['socialmedia_suggestion'])) {
            $customer->socialmedia_suggestion = "Ja";
        } else {
            $customer->socialmedia_suggestion = "Nein";
        }

        if (isset($validatedData['flyer_suggestion'])) {
            $customer->flyer_suggestion = "Ja";
        } else {
            $customer->flyer_suggestion = "Nein";
        }

        // $customer->oral_suggestion = $validatedData['oral_suggestion'];
        // $customer->ricardo_suggestion = $validatedData['ricardo_suggestion'];
        // $customer->socialmedia_suggestion = $validatedData['socialmedia_suggestion'];
        // $customer->flyer_suggestion = $validatedData['flyer_suggestion'];
        $customer->incorporated = "0";


        $customer->save();
        return redirect('thankyou');

    }
}
