@extends('app')
@section('content')
<br>
<br>
<br>
<br>
<br>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Produk</h5>
            <div class="card">
                <div class="container-fluid">
                    <form action="{{ route('submitproduk') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id">Nama Pengguna</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="biaya_produksi">Biaya Produksi</label>
                            <input type="number" name="biaya_produksi" id="biaya_produksi" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('produk') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection