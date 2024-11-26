<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Nembie\IbanRule\ValidIban;


class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Validate inputs
        $validated = $request->validate([
            'search_input' => 'nullable|string|max:255',
            'sort' => 'nullable|string|in:incorporated,name,surname,email,city,created_at',
        ]);

        // Build query using scopes
        $customers = Customer::query()
            ->search($validated['search_input'] ?? null)
            ->sort($validated['sort'] ?? null)
            ->paginate(10)
            ->withQueryString();

        return view('customers-dashboard.index', compact('customers'));
    }


    /**
     * Display the specified resource and enable editing.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        $customer->phone = formatPhoneNumberWithSpaces($customer->phone);
        $customer->iban = formatIbanWithSpaces($customer->iban);

        return view('customers-dashboard.show', compact('customer'));
    }

    public function showSuggestionsGraph()
    {
        $suggestionsData = [
            'Oral' => Customer::whereNotNull('oral_suggestion')->count(),
            'Ricardo' => Customer::whereNotNull('ricardo_suggestion')->count(),
            'Social Media' => Customer::whereNotNull('socialmedia_suggestion')->count(),
            'Flyer' => Customer::whereNotNull('flyer_suggestion')->count(),
        ];

        return view('customers-dashboard.graph', compact('suggestionsData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

        // Check and set the incorporated field
        $customer->incorporated = $request->has('incorporated') ? "1" : "0";

        // Check and set the IBAN field
        $customer->iban = $validatedData['iban'];

        // Save the updated record
        $customer->save();

        return redirect('customers')->with('success', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('customers');
    }

}
