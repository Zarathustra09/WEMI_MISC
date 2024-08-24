<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');
        $attendances = Attendance::whereDate('date_attended', $date)->get();

        return view('calendar.index', compact('attendances', 'date'));
    }


}
