<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PosController extends Controller
{
    public function store(Request $request)
    {
        $checkedUsers = $request->input('checkedUsers');
        $existingRecordsFound = false;

       Log::info($checkedUsers);

        foreach ($checkedUsers as $userId) {
            $existingAttendance = Attendance::where('user_id', $userId)
                ->whereDate('date_attended', now()->toDateString())
                ->first();

            if ($existingAttendance) {
                $existingRecordsFound = true;
            } else {
                Attendance::create([
                    'date_attended' => now(),
                    'user_id' => $userId,
                ]);
            }
        }

        if ($existingRecordsFound) {
            return response()->json(['info' => 'Some records already existed.']);
        }

        return response()->json(['success' => 'Record created successfully.']);
    }

    public function index()
    {
        $users = User::all();
        return view('pos.index', compact('users'));
    }

    public function getData()
    {
        $users = User::all();
        return response()->json(['data' => $users]);
    }

    public function createUserWithRoleZero(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'email' => null,
            'password' => null,
            'role' => 0,
        ]);

        return response()->json(['success' => 'User created successfully.', 'user' => $user]);
    }


}
