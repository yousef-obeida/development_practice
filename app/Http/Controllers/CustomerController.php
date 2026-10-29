<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerStoreResource;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Resources\CustomerResource;

class CustomerController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Customer = Customer::all();
        return CustomerResource::collection($Customer);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        $validatedData = $request->all();
        $Customer = Customer::create($validatedData);

        return CustomerResource::make($Customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Customer = Customer::findOrFail($id);
        return CustomerResource::make($Customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, string $id)
    {
        $Customer = Customer::findOrFail($id);

        $validatedData = $request->all();
        $Customer->update($validatedData);

        return CustomerResource::make($Customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Customer = Customer::findOrFail($id);
        $Customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
