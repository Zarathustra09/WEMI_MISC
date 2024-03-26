<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TMA;

class TmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tmas = TMA::all();
        return view('tmas.index', compact('tmas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tmas.create');
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

        // Create a new TMA record with the validated data
        TMA::create([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'date_started' => $request->input('date_started'),
            'date_graduated' => $request->input('date_graduated'),
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route('tmas.index')->with('success', 'Record created successfully.');
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
        $tma = TMA::findOrFail($id); // Retrieve the TMA record by its ID

        return view('tmas.edit', compact('tma')); // Pass the retrieved TMA record to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tma = TMA::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_started' => 'required|date',
            'date_graduated' => 'nullable|date',
        ]);

        // Update the TMA record with the validated data
        $tma->update([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'date_started' => $request->input('date_started'),
            'date_graduated' => $request->input('date_graduated'),
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route('tmas.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tma = TMA::findOrFail($id);
        $tma->delete();

        return redirect()->route('tmas.index')->with('success', 'Record deleted successfully.');
    }
}
