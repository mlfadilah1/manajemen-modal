<?php

namespace App\Http\Controllers;

use App\Models\pendapatan;
use App\Models\produk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    public function index()
    {
        $pendapatans = pendapatan::with(['user', 'produk'])->get();
        $produks = Produk::all();
        return view('admin.pencatatan.index',compact('pendapatans','produks'));
    }
    public function tambah()
    {
        $produk = Produk::all(); // Menampilkan daftar produk
        return view('admin.pencatatan.tambah', compact('produk'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah_terjual' => 'required|numeric',
            'total_pendapatan' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);
        Pendapatan::create([
            'user_id' => auth()->id(),
            'produk_id' => $request->produk_id,
            'jumlah_terjual' => $request->jumlah_terjual,
            'total_pendapatan' => $request->total_pendapatan,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->route('pendapatan')->with('success', 'Data Pendapatan berhasil di tambahkan.');
    }

    public function edit($id)
    {
        $pendapatan = Pendapatan::findOrFail($id);
        $produk = produk::all(); // Menampilkan daftar produk
        return view('admin.pencatatan.edit', compact('pendapatan', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah_terjual' => 'required|numeric',
            'total_pendapatan' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);
        $pendapatan = Pendapatan::findOrFail($id);
        $pendapatan->update([
            'produk_id' => $request->produk_id,
            'jumlah_terjual' => $request->jumlah_terjual,
            'total_pendapatan' => $request->total_pendapatan,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->route('pendapatan')->with('success', 'Data Pendapatan berhasil di Update.');
    }
    public function exportPDF(Request $request)
    {
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        // Validasi input tanggal
        if (!$start_date || !$end_date) {
            return redirect()->back()->with('error', 'Tanggal mulai dan selesai harus diisi!');
        }

        // Ambil data pendapatan dalam rentang tanggal yang dipilih
        $pendapatans = Pendapatan::whereBetween('tanggal', [$start_date, $end_date])
                                ->with('user', 'produk')
                                ->get();

        // Hitung total pendapatan
        $total_pendapatan = $pendapatans->sum('total_pendapatan');

        // Buat file PDF
        $pdf = Pdf::loadView('admin.pencatatan.pdf', compact('pendapatans', 'start_date', 'end_date', 'total_pendapatan'));

        // Mengunduh PDF
        return $pdf->download('pendapatan_'.$start_date.'_to_'.$end_date.'.pdf');
    }

    public function delete($id)
    {
        $pendapatan = Pendapatan::findOrFail($id);
        $pendapatan->delete();
        return redirect()->route('pendapatan')->with('success', 'Data Pendapatan berhasil di Hapus.');
    }
    public function staff()
    {
        $pendapatan = pendapatan::with(['user', 'produk'])->get();
        return view('staff.pencatatan.index',compact('pendapatan'));
    }
}
