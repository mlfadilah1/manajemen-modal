<?php

namespace App\Http\Controllers;

use App\Models\Modal;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function index()
    {
        $modals = Modal::with('user')->get();
        return view('admin.modal.index',compact('modals'));
    }
    public function tambah()
    {
        return view('admin.modal.tambah');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|string',
            'jumlah_modal' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);
        Modal::create([
            'user_id' => auth()->id(),
            'nama_usaha' => $request->nama_usaha,
            'jumlah_modal' => $request->jumlah_modal,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->route('modal')->with('success', 'Data modal berhasil di tambahkan.');
    }

    public function edit($id)
    {
        $modal = Modal::findOrFail($id);
        return view('admin.modal.edit', compact('modal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_usaha' => 'required|string',
            'jumlah_modal' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);
        $modal = Modal::findOrFail($id);
        $modal->update([
            'nama_usaha' => $request->nama_usaha,
            'jumlah_modal' => $request->jumlah_modal,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->route('modal')->with('success', 'Data Modal berhasil di update.');;
    }

    public function delete($id)
    {
        $modal = Modal::findOrFail($id);
        $modal->delete();
        return redirect()->route('modal');
    }
}
