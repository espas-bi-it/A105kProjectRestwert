<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Nembie\IbanRule\ValidIban;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


/**
 * Customer Controller
 * 
 * Indexing, Showing, Updating and Destroying Functions for existing entries
 * @access   public
 */
class CustomersController extends Controller
{
    use AuthorizesRequests;
    /**
    * Display a listing of the customers based on params.
    *
    * validatedInput checks if the user entered a search value or wanted to sort the list.
    * Sort and Search functions are defined in Customer Model
    * Paginates 10 entries
    *
    * @param    Request
    * @return   index page with list of customers
    */
    public function index(Request $request)
    {
        // Validate inputs
        $validatedInput = $request->validate([
            'search_input' => 'nullable|string|max:255',
            'sort' => 'nullable|string|in:incorporated,name,surname,email,city,created_at',
        ]);

        // Build query using scopes
        $customers = Customer::query()
            ->search($validatedInput['search_input'] ?? null)
            ->sort($validatedInput['sort'] ?? null)
            ->paginate(10)
            ->withQueryString();

        return view('customers-dashboard.index', compact('customers'));
    }


    /**
    * Display the specified resource and enable editing.
    *
    * Customer is found by ID
    * Change output of phone and IBAN number for better user experience
    *
    * @param    string
    * @return   customers-dashboard.show page with customer information
    */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        $customer->phone = formatPhoneNumberWithSpaces($customer->phone);
        $customer->iban = formatIbanWithSpaces($customer->iban);

        return view('customers-dashboard.show', compact('customer'));
    }


    /**
    * Display graph of commonly ticked Suggestions
    *
    * @return   customers-dashboard-graph page 
    */
    public function showSuggestionsGraph()
    {
        $suggestionsData = [
            __('fields.oral_suggestion') => Customer::where('oral_suggestion', true)->count(),
            __('fields.ricardo_suggestion') => Customer::where('ricardo_suggestion', true)->count(),
            __('fields.socialmedia_suggestion') => Customer::where('socialmedia_suggestion', true)->count(),
            __('fields.flyer_suggestion') => Customer::where('flyer_suggestion', true)->count(),
        ];

        return view('customers-dashboard.graph', compact('suggestionsData'));
    }

    /**
    * Update the specified resource in storage.
    *
    * Update customer data in DB. Revert phone and IBAN formating changes made in show
    * Updates user who made the changes in updated_by
    * Checks if incorporated has been changed. 1 for true, 0 for false
    * Checks entered IBAN number with the ValidateIban library
    *
    * @param    Request
    * @param    string
    * @return   customers-dashboard.index page
    */
    public function update(Request $request, string $id)
    {

        $this->authorize('hasAdvancedPermissions', User::class);

        // Find the customer or fail if not found
        $customer = Customer::findOrFail($id);

        $request->merge([
            'iban' => str_replace(' ', '', $request->iban),  // Remove spaces from IBAN
            'phone' => str_replace(' ', '', $request->phone),  // Remove spaces from phone
        ]);


        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|min:2|string',
            'company' => 'nullable|string',
            'name' => 'required|string',
            'surname' => 'required|string',
            'address' => 'required|string',
            'po_box' => 'nullable|string',
            'zip' => 'required|string',
            'city' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|regex:/^0\d{9}$/',
            'iban' => ['required', 'string', new ValidIban],
            'bankname' => 'required|string',
            'alt_title' => 'nullable|min:2|string',
            'alt_name' => 'nullable|string',
            'alt_surname' => 'nullable|string',
            'alt_address' => 'nullable|string',
            'alt_zip' => 'nullable|string',
            'alt_city' => 'nullable|string',
            'incorporated' => 'nullable|boolean',
        ]);

        // Update fields
        $customer->fill($validatedData);

        // Get the currently logged-in user's name
        $customer->updated_by = Auth::user()->name;

        // Check and set the incorporated field
        $customer->incorporated = $request->has('incorporated') ? "1" : "0";

        // Check and set the IBAN field
        $customer->iban = $validatedData['iban'];

        // Save the updated record
        $customer->save();

        $message = $customer->name . ' ' . $customer->surname . ' has been updated';


        return redirect('customers')->with('success', $message);
    }

    /**
    * Move the specified resource from storage to customers_archive
    *
    * Soft delete to ensure no data is lost by mistake
    *
    * @param    string
    * @return   customers-dashboard.index page
    */
    public function destroy(string $id)
    {
        $this->authorize('hasAdvancedPermissions', User::class);

        // Find the customer by ID
        $customer = Customer::find($id);

        if ($customer) {
            // Raw insert the customer's data to the 'customers_archive' table
            \DB::table('customers_archive')->insert([
                    'id' => $customer->id,
                    'title' => $customer->title,
                    'company' => $customer->company,
                    'name' => $customer->name,
                    'surname' => $customer->surname,
                    'address' => $customer->address,
                    'po_box' => $customer->po_box,
                    'zip' => $customer->zip,
                    'city' => $customer->city,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                    'iban' => $customer->iban,
                    'bankname' => $customer->bankname,
                    'alt_title' => $customer->alt_title,
                    'alt_name' => $customer->alt_name,
                    'alt_surname' => $customer->alt_surname,
                    'alt_address' => $customer->alt_address,
                    'alt_zip' => $customer->alt_zip,
                    'alt_city' => $customer->alt_city,
                    'oral_suggestion' => $customer->oral_suggestion,
                    'ricardo_suggestion' => $customer->ricardo_suggestion,
                    'socialmedia_suggestion' => $customer->socialmedia_suggestion,
                    'flyer_suggestion' => $customer->flyer_suggestion,
                    'incorporated' => $customer->incorporated,
                    'created_at' => $customer->created_at,
                    'updated_by' => Auth::user()->name,
                    'updated_at' => now(),
                    ]);

            $message = $customer->name . ' ' . $customer->surname . ' has been deleted';
            // Get the currently logged-in user's name

            // Delete the customer from the original table
            $customer->delete();

            return redirect('customers')->with('success', $message);
        }
        else
        {
            return redirect('customers')->with('error', 'Specified entry could not be found.');
        }
    }
}
