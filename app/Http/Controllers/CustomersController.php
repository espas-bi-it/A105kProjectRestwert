<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', ['customers' => $customers]);
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
        // $customer->title = $request->input('title');
        // $customer->band = $request->input('band');

        $validatedData = $request->validate([
            'title' => 'required|min:2',
            'band' => 'required',
        ]);

        $customer = new Customer();

        $customer->title = $validatedData['title'];
        $customer->band = $validatedData['band'];

        $customer->save();
        return redirect('customers');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::find($id);
        $validatedData = $request->validate([
            'title' => 'required|min:2',
            'band' => 'required',
        ]);

        $customer->title = $validatedData['title'];
        $customer->band = $validatedData['band'];

        $customer->save();
        return redirect('customers');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
