<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baptism;

class BaptismController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baptisms = Baptism::all();
        return view('baptism.index', compact('baptisms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('baptism.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_baptised' => 'required|date',
        ]);

        Baptism::create($request->all());
        return redirect()->route('baptism.index')->with('success', 'Record created successfully.');
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
    public function edit(string $id)
    {
        $baptism = Baptism::findOrFail($id);
        return view('baptism.edit', compact('baptism'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_baptised' => 'required|date',
        ]);

        $baptism = Baptism::findOrFail($id);

        $baptism->update($request->all());
        return redirect()->route('baptism.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $baptism = Baptism::findOrFail($id);
        $baptism->delete();
        return redirect()->route('baptism.index')->with('success', 'Record deleted successfully.');

    }


}
