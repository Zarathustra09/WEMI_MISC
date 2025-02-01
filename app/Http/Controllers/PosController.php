<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PosController extends Controller
{
    public function store(Request $request)
    {
        $checkedUsers = $request->input('checkedUsers');
        $existingRecordsCount = 0;
        $newRecordsCount = 0;
        $duplicateUsers = [];

        Log::info($checkedUsers);

        foreach ($checkedUsers as $userId) {
            $existingAttendance = Attendance::where('user_id', $userId)
                ->whereDate('date_attended', Carbon::now('Asia/Manila')->toDateString())
                ->first();

            if ($existingAttendance) {
                if (!in_array($userId, $duplicateUsers)) {
                    $duplicateUsers[] = $userId;
                    $existingRecordsCount++;
                }
            } else {
                Attendance::create([
                    'date_attended' => Carbon::now('Asia/Manila'),
                    'user_id' => $userId,
                ]);
                $newRecordsCount++;
            }
        }

        if ($existingRecordsCount > 0 && $newRecordsCount > 0) {
            return response()->json([
                'status' => 'partial_success',
                'existingRecordsCount' => $existingRecordsCount,
                'newRecordsCount' => $newRecordsCount,
            ]);
        } elseif ($existingRecordsCount > 0 && $newRecordsCount == 0) {
            return response()->json([
                'status' => 'all_duplicates',
                'existingRecordsCount' => $existingRecordsCount,
            ]);
        } elseif ($existingRecordsCount == 0 && $newRecordsCount > 0) {
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'no_records',
            ]);
        }
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
