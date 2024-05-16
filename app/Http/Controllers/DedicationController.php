<?php

namespace App\Http\Controllers;

use App\Models\Dedication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class DedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all dedications with their associated users
        $dedications = Dedication::with('user')->get();

        // Return view with dedications data
        return view('dedication.index', compact('dedications'));
    }

    public function create()
    {
        $users = User::all();
        // Return view for creating a new dedication
        return view('dedication.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'date_dedicated' => 'required|date',
            'user_id' => 'required|exists:users,id|unique:dedications,user_id',
            // Add validation rules for other fields as needed
        ]);


        // Create a new dedication
        Dedication::create($request->all());

        // Redirect back to index page with success message
        return redirect()->route('dedications.index')->with('success', 'Dedication created successfully.');
    }

    public function show(Dedication $dedication)
    {
        // Return view with the specified dedication data
        return view('dedication.show', compact('dedication'));
    }

    public function edit(Dedication $dedication)
    {

        return view('dedication.edit', compact('dedication'));
    }

    public function update(Request $request, Dedication $dedication)
    {
        // Validate request data
        $dedication->update([
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'date_dedicated' => $request->date_dedicated,
            // Update other fields as needed
        ]);

        // Update the dedication
        $dedication->update($request->all());

        // Redirect back to index page with success message
        return redirect()->route('dedications.index')->with('success', 'Dedication updated successfully.');
    }

    public function destroy(Dedication $dedication)
    {
        // Delete the dedication
        $dedication->delete();

        // Redirect back to index page with success message
        return redirect()->route('dedications.index')->with('success', 'Dedication deleted successfully.');
    }

    public function print($id)
    {
        $dedication = Dedication::with('user')->find($id);
        $dedication->date_dedicated_formatted = Carbon::parse($dedication->date_dedicated)->format('F j, Y');
       return view('pdf.dedication', compact('dedication'));
    }

}
