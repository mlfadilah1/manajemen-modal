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
            <h5 class="card-title fw-semibold mb-4">Edit Menu</h5>
            <div class="card">
                <div class="container-fluid">
                    @foreach ($produk as $result)
                    <form action="{{ route('updateproduk',$result->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Nama Pengguna</label>
                                <input type="text" class="form-control" id="user_id" name="nama_menu"
                                    value="{{ $result->user_id }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                    value="{{ $result->nama_produk }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga_jual" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="harga_jual" name="harga_jual"
                                    value="{{ $result->harga_jual }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="biaya_produksi" class="form-label">Harga Produksi</label>
                                <input type="number" class="form-control" id="biaya_produksi" name="biaya_produksi"
                                    value="{{ $result->biaya_produksi }}" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('menu') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary" id="submit">Simpan Perubahan</button>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection