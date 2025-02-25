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
            <h5 class="card-title fw-semibold mb-4">Tambah operasional</h5>
            <div class="card">
                <div class="container-fluid">
                    <form action="{{ route('submitoperasional') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id">Nama Pengguna</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_biaya">Jenis Biaya</label>
                            <input type="text" name="jenis_biaya" id="jenis_biaya" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipe">Tipe</label>
                            <select name="tipe" id="tipe" class="form-control" required>
                                <option value="tetap">Tetap</option>
                                <option value="variabel">Variabel</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
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