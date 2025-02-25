@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Laporan Pendapatan -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body" align='center'>
                    <h5 class="card-title">Pendapatan Harian</h5>
                    <h6>Terdapat <strong>{{ $pendapatan }}</strong> laporan pendapatan untuk hari ini.</h6>
                    <a href="pendapatan" class="btn btn-primary">Pendapatan</a>
                </div>
            </div>
        </div>

        <!-- Laporan Biaya Operasional -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body" align='center'>
                    <h5 class="card-title">Biaya Operasional Bulanan</h5>
                    <h6>Terdapat <strong>{{ $operasional }}</strong> laporan biaya operasional untuk bulan ini.</h6>
                    <a href="operasional" class="btn btn-primary">Operasional</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
