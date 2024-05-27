<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        $labels = [];
        $data = [];
        $colors = [
            '#FCE4EC',  // Pastel Pink
            '#E5D7F2',  // Lavender
            '#98DF8A',  // Mint Green
            '#FFE0B2',  // Light Peach
            '#A9D1ED'   // Baby Blue
        ];

        for ($i = 1; $i <= 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $count = 0;

            foreach ($users as $user) {
                if ($user->month == $i) {
                    $count = $user->count;
                    break;
                }
            }
            array_push($labels, $month);
            array_push($data, $count);
        }

        $datasets = [
            [
                'label' => 'New Users',
                'backgroundColor' => $colors,
                'data' => $data
            ]
        ];

        return view('dashboard', compact('labels', 'datasets'));
    }

}
