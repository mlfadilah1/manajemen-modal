<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = produk::all();
        return view('admin.produk.index', compact('produk'));
    }
    public function tambah()
    {
        return view('admin.produk.tambah');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'harga_jual' => 'required|numeric',
            'biaya_produksi' => 'required|numeric',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan.');
        return redirect('/tambahproduk')->with('error', 'Data produk gagal di tambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'harga_jual' => 'required|numeric',
            'biaya_produksi' => 'required|numeric',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
    }
}
