<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Attendance;

class PosController extends Controller
{
    public function store(Request $request)
    {
        $checkedUsers = $request->input('checkedUsers');
        $existingRecordsFound = false;

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


}
