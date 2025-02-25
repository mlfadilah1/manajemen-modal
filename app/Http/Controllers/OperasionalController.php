<?php

namespace App\Http\Controllers;

use App\Models\biaya_oprasional;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OperasionalController extends Controller
{
    public function index()
    {
        $biaya_operasional = biaya_oprasional::all();
        return view('admin.operasional.index', compact('biaya_operasional'));
    }
    public function staff()
    {
        return view('staff.operasional.index');
    }
    public function tambah()
    {
        return view('admin.operasional.tambah');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'jenis_biaya' => 'required|string',
            'jumlah' => 'required|numeric',
            'tipe' => 'required|in:tetap,variabel',
            'tanggal' => 'required|date',
        ]);

        biaya_oprasional::create($request->all());

        return redirect()->route('operasional')->with('success', 'Biaya operasional berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $biaya_operasional = biaya_oprasional::findOrFail($id);
        return view('admin.operasional.edit', compact('biaya_operasional'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_biaya' => 'required|string',
            'jumlah' => 'required|numeric',
            'tipe' => 'required|in:tetap,variabel',
            'tanggal' => 'required|date',
        ]);

        $biaya_operasional = biaya_oprasional::findOrFail($id);
        $biaya_operasional->update($request->all());

        return redirect()->route('operasional')->with('success', 'Biaya operasional berhasil diperbarui.');
    }

    public function delete($id)
    {
        $biaya_operasional = biaya_oprasional::findOrFail($id);
        $biaya_operasional->delete();

        return redirect()->route('operasional')->with('success', 'Biaya operasional berhasil dihapus.');
    }
    public function exportPDF(Request $request)
{
    // Ambil input tanggal dan tipe dari request
    $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $tipe = $request->input('tipe'); // "tetap", "variabel", atau "semua"

        // Query untuk mengambil data biaya operasional
        $query = biaya_oprasional::with('user')->whereBetween('tanggal', [$startDate, $endDate]);

        if ($tipe == 'tetap' || $tipe == 'variabel') {
            $query->where('tipe', $tipe);
        }

        // Ambil semua data jika tipe 'semua'
        $operasional = $query->get();

        // Hitung total biaya
        $totalTetap = biaya_oprasional::where('tipe', 'tetap')->whereBetween('tanggal', [$startDate, $endDate])->sum('jumlah');
        $totalVariabel = biaya_oprasional::where('tipe', 'variabel')->whereBetween('tanggal', [$startDate, $endDate])->sum('jumlah');
        $totalKeseluruhan = $totalTetap + $totalVariabel;

        // Debugging (Hapus setelah dipastikan berjalan)
        // dd($operasional->toArray(), $totalTetap, $totalVariabel, $totalKeseluruhan);

        // Render tampilan PDF
        $pdf = PDF::loadView('admin.operasional.pdf', compact(
            'startDate', 'endDate', 'tipe', 'operasional', 'totalTetap', 'totalVariabel', 'totalKeseluruhan'
        ));
        
        return $pdf->stream('laporan-biaya.pdf');
}
}
