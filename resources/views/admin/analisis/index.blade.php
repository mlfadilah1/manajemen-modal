@extends('app')
@section('title',' Perhitungan Pendapatan | Mr.Hoyy')
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
    // Konfirmasi hapus data
    $(document).on('click', '.delete-button', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Tombol Tambah Data
    $('#addProductBtn').click(function() {
        $('#productForm').attr('action', '{{ route('submitanalisis') }}');
        $('#modalTitle').text('Tambah Data');
        $('#productForm')[0].reset();
        $('#methodField').html('');
        $('#productModal').modal('show');
    });

    // Tombol Edit Data
    $(document).on('click', '.edit-button', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var biaya_tetap = $(this).data('biaya_tetap');
        var biaya_variabel_per_unit = $(this).data('biaya_variabel_per_unit');
        var harga_jual_per_unit = $(this).data('harga_jual_per_unit');
        var bep_unit = $(this).data('bep_unit');
        var bep_rupiah = $(this).data('bep_rupiah');
        var total_pendapatan = $(this).data('total_pendapatan');
        var total_investasi = $(this).data('total_investasi');
        var laba_bersih = $(this).data('laba_bersih');
        var roi = $(this).data('roi');
        var periode_analisis = $(this).data('periode_analisis');

        $('#productForm').attr('action', '/updateanalisis' + id);
        $('#modalTitle').text('Edit Data');
        $('#name').val(name);
        $('#biaya_tetap').val(biaya_tetap);
        $('#biaya_variabel_per_unit').val(biaya_variabel_per_unit);
        $('#harga_jual_per_unit').val(harga_jual_per_unit);
        $('#bep_unit').val(bep_unit);
        $('#bep_rupiah').val(bep_rupiah);
        $('#total_pendapatan').val(total_pendapatan);
        $('#total_investasi').val(total_investasi);
        $('#laba_bersih').val(laba_bersih);
        $('#roi').val(roi);
        $('#periode_analisis').val(periode_analisis);
        $('#methodField').html('<input type="hidden" name="_method" value="PUT">');
        $('#productModal').modal('show');
    });
});
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Laporan Analisis</h5>
                <button id="addProductBtn" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Laporan</button>
                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Biaya Tetap</th>
                                        <th>Biaya Variabel/Unit</th>
                                        <th>Harga Jual/Unit</th>
                                        <th>Total Pendapatan</th>
                                        <th>Total Investasi</th>
                                        <th>BEP Unit</th>
                                        <th>BEP Rupiah</th>
                                        <th>Biaya Operasional</th>
                                        <th>Laba Bersih</th>
                                        <th>ROI (%)</th>
                                        <th>Periode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @if ($analisis)
                                        @foreach ($analisis as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->user->name }}</td>
                                                <td>Rp {{ number_format($data->biaya_tetap, 2, ',', '.') }}</td>
                                                <td>Rp {{ number_format($data->biaya_variabel_per_unit, 2, ',', '.') }}</td>
                                                <td>Rp {{ number_format($data->harga_jual_per_unit, 2, ',', '.') }}</td>
                                                <td>Rp {{ number_format($data->total_pendapatan, 2, ',', '.') }}</td>
                                                <td>Rp {{ number_format($data->total_investasi, 2, ',', '.') }}</td>
                                                <td>{{ number_format($data->bep_unit, 2) }}</td>
                                                <td>Rp {{ number_format($data->bep_rupiah, 2, ',', '.') }}</td>
                                                <td>Rp {{ number_format($data->biaya_tetap + ($data->bep_unit * $data->biaya_variabel_per_unit), 2, ',', '.') }}</td> <!-- Biaya operasional dihitung otomatis -->
                                                <td>Rp {{ number_format($data->laba_bersih, 2, ',', '.') }}</td>
                                                <td>{{ number_format($data->roi, 2) }}%</td>
                                                <td>{{ \Carbon\Carbon::parse($data->periode_analisis)->format('F Y') }}</td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-light ti ti-dots-vertical" type="button"
                                                            id="menuOptions" data-bs-toggle="dropdown" aria-expanded="false"
                                                            style="border: none; background: none;">
                                                            <i class="ti ti-more" style="font-size: 1.5rem;"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="menuOptions">
                                                            <li>
                                                                <a href="#" class="dropdown-item edit-button"
                                                                    data-id="{{ $data->id }}"
                                                                    data-name="{{ $data->user->name }}"
                                                                    data-biaya_tetap="{{ $data->biaya_tetap }}"
                                                                    data-biaya_variabel_per_unit="{{ $data->biaya_variabel_per_unit }}"
                                                                    data-harga_jual_per_unit="{{ $data->harga_jual_per_unit }}"
                                                                    data-bep_unit="{{ $data->bep_unit }}"
                                                                    data-bep_rupiah="{{ $data->bep_rupiah }}"
                                                                    data-total_pendapatan="{{ $data->total_pendapatan }}"
                                                                    {{-- data-biaya_operasional="{{ $data->biaya_operasional }}" --}}
                                                                    data-total_investasi="{{ $data->total_investasi }}"
                                                                    data-laba_bersih="{{ $data->laba_bersih }}"
                                                                    data-roi="{{ $data->roi }}"
                                                                    data-periode_analisis="{{ $data->periode_analisis }}">
                                                                    <i class="ti ti-pencil"></i> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('deleteanalisis', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item text-danger delete-button">
                                                                        <i class="ti ti-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Data -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm" method="POST">
                        @csrf
                        <div id="methodField"></div>
                        <div class="mb-3">
                            <label class="form-label" for="user_id">Nama Pengguna</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Biaya Tetap (Rp)</label>
                            <input type="number" class="form-control" name="biaya_tetap" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Biaya Variabel per Unit (Rp)</label>
                            <input type="number" class="form-control" name="biaya_variabel_per_unit" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga Jual per Unit (Rp)</label>
                            <input type="number" class="form-control" name="harga_jual_per_unit" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Pendapatan (Rp)</label>
                            <input type="number" class="form-control" name="total_pendapatan" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Investasi (Rp)</label>
                            <input type="number" class="form-control" name="total_investasi" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Periode Analisis</label>
                            <input type="month" class="form-control" name="periode_analisis" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
