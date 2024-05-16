<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Attendance;

class PosController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pos.index', compact('users'));
    }

    public function store(Request $request)
    {
        // Get the array of checked user IDs from the request
        $checkedUsers = $request->input('checkedUsers');

        // Loop through each checked user ID and validate before saving
        foreach ($checkedUsers as $userId) {
            // Check if an attendance record already exists for the user and today's date
            $existingAttendance = Attendance::where('user_id', $userId)
                ->whereDate('date_attended', now()->toDateString())
                ->first();

            // If no existing attendance record found, create a new one
            if (!$existingAttendance) {
                // Create a new attendance record for the user
                Attendance::create([
                    'date_attended' => now(), // Use the current date
                    'user_id' => $userId,
                ]);
            }
        }
        return redirect()->route('pos.index')->with('success', 'Record created successfully.');

    }


}
