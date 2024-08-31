<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function generateAttendanceReport(Request $request)
    {
        $reportType = $request->input('report_type');
        $attendances = [];

        switch ($reportType) {
            case 'monthly':
                $attendances = $this->getMonthlyAttendance();
                break;
            case 'quarterly':
                $attendances = $this->getQuarterlyAttendance();
                break;
            case 'semi-annualy':
                $attendances = $this->getSemiAnnualAttendance();
                break;
            case 'annually':
                $attendances = $this->getAnnualAttendance();
                break;
        }

        $attendances = $attendances->groupBy('user_id')->map(function ($attendance) {
            return [
                'user' => $attendance->first()->user,
                'count' => $attendance->count(),
            ];
        });

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml(view('prints.report-attendance', compact('attendances', 'reportType'))->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('attendance_report.pdf');
    }

    private function getMonthlyAttendance()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        return Attendance::with('user')->whereBetween('date_attended', [$start, $end])->get();
    }

    private function getQuarterlyAttendance()
    {
        $currentMonth = Carbon::now()->month;
        $start = Carbon::now()->startOfQuarter();
        $end = Carbon::now()->endOfQuarter();
        return Attendance::with('user')->whereBetween('date_attended', [$start, $end])->get();
    }

    private function getSemiAnnualAttendance()
    {
        $currentMonth = Carbon::now()->month;
        if ($currentMonth <= 6) {
            $start = Carbon::now()->startOfYear();
            $end = Carbon::now()->startOfYear()->addMonths(5)->endOfMonth();
        } else {
            $start = Carbon::now()->startOfYear()->addMonths(6);
            $end = Carbon::now()->endOfYear();
        }
        return Attendance::with('user')->whereBetween('date_attended', [$start, $end])->get();
    }

    private function getAnnualAttendance()
    {
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfYear();
        return Attendance::with('user')->whereBetween('date_attended', [$start, $end])->get();
    }
}
