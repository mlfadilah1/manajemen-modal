<?php

namespace App\Http\Controllers;

use App\Models\analisi_pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BRController extends Controller
{
    public function index()
    {
        $analisis = analisi_pendapatan::with('user')->get();
        return view('admin.analisis.index', compact('analisis'));
    }
    public function tambah()
    {
        return view('admin.analisis.tambah');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'biaya_tetap' => 'required|numeric',
            'biaya_variabel_per_unit' => 'required|numeric',
            'harga_jual_per_unit' => 'required|numeric',
            'total_pendapatan' => 'required|numeric',
            'total_investasi' => 'required|numeric',
            'periode_analisis' => 'required|date_format:Y-m',
        ]);
    
        try {
            $bep_unit = $request->biaya_tetap / ($request->harga_jual_per_unit - $request->biaya_variabel_per_unit);
            $bep_rupiah = $bep_unit * $request->harga_jual_per_unit;

            // Hitung total biaya variabel berdasarkan unit yang terjual, bukan BEP Unit
            $total_biaya_variabel = $request->biaya_variabel_per_unit * ($request->total_pendapatan / $request->harga_jual_per_unit);

            // Hitung laba bersih dengan benar
            $laba_bersih = $request->total_pendapatan - ($request->biaya_tetap + $total_biaya_variabel);

            // Hitung ROI
            $roi = ($laba_bersih / $request->total_investasi) * 100;

    
            analisi_pendapatan::create([
                'user_id' => auth()->id(),
                'biaya_tetap' => $request->biaya_tetap,
                'biaya_variabel_per_unit' => $request->biaya_variabel_per_unit,
                'harga_jual_per_unit' => $request->harga_jual_per_unit,
                'bep_unit' => $bep_unit,
                'bep_rupiah' => $bep_rupiah,
                'total_pendapatan' => $request->total_pendapatan,
                'total_investasi' => $request->total_investasi,
                'laba_bersih' => $laba_bersih,
                'roi' => $roi,
                'periode_analisis' => $request->periode_analisis,
            ]);
    
            return redirect()->route('analisis')->with('success', 'Data berhasil ditambahkan!');
        
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data! ' . $e->getMessage());
        }
    }

    public function show(analisi_pendapatan $analisis_keuangan)
    {
        return view('analisis_keuangan.show', compact('analisis_keuangan'));
    }

    public function edit(analisi_pendapatan $analisis_keuangan)
    {
        return view('admin.analisis.edit', compact('analisis_keuangan'));
    }

    public function update(Request $request, analisi_pendapatan $analisis_keuangan)
    {
        $request->validate([
            'biaya_tetap' => 'required|numeric',
            'biaya_variabel_per_unit' => 'required|numeric',
            'harga_jual_per_unit' => 'required|numeric',
            'total_pendapatan' => 'required|numeric',
            'biaya_operasional' => 'required|numeric',
            'total_investasi' => 'required|numeric',
            'periode_analisis' => 'required|date',
        ]);

        $analisis_keuangan->update($request->all());

        return redirect()->route('analisis_keuangan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        DB::table('analisis_pendapatans')->where('id', $id)->delete();
        return redirect('/analisis')->with('success', 'Data user berhasil dihapus.');
    }
}
