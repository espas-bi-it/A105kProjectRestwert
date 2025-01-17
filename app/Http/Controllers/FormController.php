<?php

namespace App\Http\Controllers;

use App\Mail\SignUp;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Nembie\IbanRule\ValidIban;


/**
* Form Controller
*
* Indexing, Creating and Storing Functions to create new entries
* @access   public
*/
class FormController extends Controller
{

    /**
    * Thank you page after signing up.
    *
    * @return   form.thankyou page
    */
    public function index()
    {
        return view('form.thankyou');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return   form.create page
    */
    public function create()
    {
        return view('customers.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * Remove spaces in phone and IBAN number for validation, if applicable
    * Validate data to make sure all non-nullable entries are given
    * populare new customer with given data
    * Manually set suggestions to "Ja" or "Nein", depending if it was ticked or not
    * Set incorporated to default 0 (false)
    * Save entry to DB and create thankyou email with given email and name + surname
    *
    * @params   Request
    * @return   form.thankyou page with customized message
    */
    public function store(Request $request)
    {
        $request->merge([
            'iban' => str_replace(' ', '', $request->iban), 
            'phone' => str_replace(' ', '', $request->phone),
            // Convert suggestion inputs to booleans
            'oral_suggestion' => $request->has('oral_suggestion'),
            'ricardo_suggestion' => $request->has('ricardo_suggestion'),
            'socialmedia_suggestion' => $request->has('socialmedia_suggestion'),
            'flyer_suggestion' => $request->has('flyer_suggestion'),
        ]);

        $validatedData = $request->validate([
            'title' => 'required|min:2',
            'company' => '',
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'po_box' => '',
            'zip' => 'required',
            'city' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'iban' => ['required', 'string', new ValidIban],
            'bankname' => 'required',
            'alt_title' => '',
            'alt_name' => '',
            'alt_surname' => '',
            'alt_address' => '',
            'alt_zip' => '',
            'alt_city' => '',
            'oral_suggestion' => '',
            'ricardo_suggestion' => '',
            'socialmedia_suggestion' => '',
            'flyer_suggestion' => '',
            'incorporated' => '',
            'g-recaptcha-response' => 'required'
        ]);

        $customer = new Customer();

        $customer->title = $validatedData['title'];
        $customer->company = $validatedData['company'];
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
        $customer->alt_zip = $validatedData['alt_zip'];
        $customer->alt_city = $validatedData['alt_city'];

        // Store suggestions as booleans
        $customer->oral_suggestion = $validatedData['oral_suggestion'];
        $customer->ricardo_suggestion = $validatedData['ricardo_suggestion'];
        $customer->socialmedia_suggestion = $validatedData['socialmedia_suggestion'];
        $customer->flyer_suggestion = $validatedData['flyer_suggestion'];

        $customer->incorporated = false;

        $customer->save();

        Mail::to($customer->email)->send(new SignUp($customer));

        return redirect('thankyou');
    }
}
