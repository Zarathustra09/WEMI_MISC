<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $users = User::all();
        return view('tmas.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:tmas,user_id',
            'date_started' => 'required|date',
            'date_graduated' => 'nullable|date',
        ]);

        // Create a new TMA record with the validated data
        TMA::create($request->all());

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
            'date_started' => 'required|date',
            'date_graduated' => 'nullable|date',
        ]);

        // Update the TMA record with the validated data
        $tma->update($request->all());
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
