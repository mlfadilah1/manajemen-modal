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
            <h5 class="card-title fw-semibold mb-4">Tambah Pendapatan</h5>
            <div class="card">
                <div class="container-fluid">
                    <form action="{{ route('submitpendapatan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id">Nama Pengguna</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>
                        <div class="mb-3">
                            <label for="produk_id">Produk</label>
                            <select name="produk_id" id="produk_id" class="form-control" required>
                                @foreach($produk as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_terjual">Jumlah Terjual</label>
                            <input type="number" name="jumlah_terjual" id="jumlah_terjual" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_pendapatan">Total Pendapatan</label>
                            <input type="number" name="total_pendapatan" id="total_pendapatan" class="form-control" required>
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