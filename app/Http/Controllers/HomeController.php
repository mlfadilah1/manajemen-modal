<?php

namespace App\Http\Controllers;

use App\Models\analisi_pendapatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $periode = $request->get('periode', Carbon::now()->subMonth()->format('Y-m'));

        $analisisData = analisi_pendapatan::where('periode_analisis', 'like', "$periode%")
            ->orderBy('periode_analisis', 'asc')
            ->get();

        $chartData = [
            'labels' => $analisisData->pluck('periode_analisis'),
            'datasets' => [
                [
                    'label' => 'BEP Unit',
                    'data' => $analisisData->pluck('bep_unit'),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.7)',
                    'borderRadius' => 10
                ],
                [
                    'label' => 'BEP Rupiah',
                    'data' => $analisisData->pluck('bep_rupiah'),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.7)',
                    'borderRadius' => 10
                ],
                [
                    'label' => 'Laba Bersih',
                    'data' => $analisisData->pluck('laba_bersih'),
                    'backgroundColor' => 'rgba(255, 159, 64, 0.7)',
                    'borderRadius' => 10
                ],
                [
                    'label' => 'ROI',
                    'data' => $analisisData->pluck('roi'),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.7)',
                    'borderRadius' => 10
                ]
            ]
        ];

        return view('admin.index', compact('chartData', 'periode'));
    }
}
