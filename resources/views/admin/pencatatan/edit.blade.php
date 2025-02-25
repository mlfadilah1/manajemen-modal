@extends('app')
@section('content')

<div class="container">
    <h2>Edit Pendapatan</h2>
    <form action="{{ route('pendapatan.update', $pendapatan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="produk_id">Produk</label>
            <select name="produk_id" id="produk_id" class="form-control" required>
                @foreach($produk as $item)
                    <option value="{{ $item->id }}" {{ $pendapatan->produk_id == $item->id ? 'selected' : '' }}>{{ $item->nama_produk }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="jumlah_terjual">Jumlah Terjual</label>
            <input type="number" name="jumlah_terjual" id="jumlah_terjual" class="form-control" value="{{ $pendapatan->jumlah_terjual }}" required>
        </div>
        <div class="form-group">
            <label for="total_pendapatan">Total Pendapatan</label>
            <input type="number" name="total_pendapatan" id="total_pendapatan" class="form-control" value="{{ $pendapatan->total_pendapatan }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $pendapatan->tanggal }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection