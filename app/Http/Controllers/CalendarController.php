<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');
        $attendances = Attendance::whereDate('date_attended', $date)->get();

        return view('calendar.index', compact('attendances', 'date'));
    }

    public function print(Request $request)
    {
        $date = $request->query('date');
        $attendances = Attendance::with('user')->whereDate('date_attended', $date)->get();

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml(view('prints.attendance', compact('attendances'))->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('attendance.pdf');
    }


}
