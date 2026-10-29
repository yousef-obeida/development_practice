<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request ;
use App\Http\Requests\StaffStoreRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\Http\Resources\StaffResources;


class StaffController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::all();
        return StaffResources::collection($staff);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaffStoreRequest $request)
    {
        $validatedData = $request->validated();
        $staff = Staff::create($validatedData);

        return StaffResources::make($staff);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = Staff::findOrFail($id);
        return StaffResources::make($staff);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StaffUpdateRequest $request, string $id)
    {
        $staff = Staff::findOrFail($id);

        $validatedData = $request->validated();
        $staff->update($validatedData);

        return StaffResources::make($staff);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return response()->json(['message' => 'Staff deleted successfully']);
    }
}
