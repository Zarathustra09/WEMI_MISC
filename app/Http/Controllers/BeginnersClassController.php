<?php

namespace App\Http\Controllers;

use App\Models\BeginnersClass;
use Illuminate\Http\Request;

class BeginnersClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beginners = BeginnersClass::all();
        return view('bc.index', compact('beginners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_started' => 'required|date',
            'date_graduated' => 'nullable|date',
        ]);

        // Create a new BeginnersClass instance and fill it with the validated data
        BeginnersClass::create($request->all());

        // Redirect back to the index page with a success message
        return redirect()->route('bc.index')->with('success', 'Record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the beginner class by its ID
        $beginner = BeginnersClass::findOrFail($id);

        // Pass the beginner class data to the view for editing
        return view('bc.edit', compact('beginner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_started' => 'required|date',
            'date_graduated' => 'nullable|date',
        ]);

        // Find the beginner class by its ID
        $beginner = BeginnersClass::findOrFail($id);

        // Update the beginner class data with the validated data
        $beginner->update($request->all());

        // Redirect back to the index page with a success message
        return redirect()->route('bc.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bc = BeginnersClass::findOrFail($id);
        $bc->delete();

        return redirect()->route('bc.index')->with('success', 'Record deleted successfully.');
    }

    public function print($id)
    {
        $beginner = BeginnersClass::findOrFail($id);
        return view('pdf.bc', compact('beginner'));
    }

}
