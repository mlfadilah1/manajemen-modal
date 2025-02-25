<?php

namespace App\Http\Controllers;

use App\Models\biaya_oprasional;
use App\Models\pendapatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $thisMonth = date('Y-m');  // Get the current month (YYYY-MM)

        // Calculate pendapatan for today
        $pendapatan = pendapatan::whereDate('tanggal', $today)->count();

        // Calculate operasional for the current month
        $operasional = biaya_oprasional::whereMonth('tanggal', date('m'))
                                        ->whereYear('tanggal', date('Y'))
                                        ->count();

        return view('staff.index', compact('pendapatan', 'operasional'));
    }
}
