@extends('app')
@section('title','Pendapatan | Mr.Hoyy')
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Delete confirmation
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

        // Show modal for adding a product
        $('#addProductBtn').click(function() {
            $('#productForm').attr('action', '{{ route('submitpendapatan') }}');
            $('#modalTitle').text('Tambah Pendapatan');
            $('#productForm')[0].reset();
            $('#productModal').modal('show');
        });

        // Show modal for editing a product
        $('.edit-button').click(function() {
            var id = $(this).data('id');
            var produk_id = $(this).data('produk-id'); 
            var jumlah_terjual = $(this).data('jumlah-terjual');
            var total_pendapatan = $(this).data('total-pendapatan');
            var tanggal = $(this).data('tanggal');

            $('#productForm').attr('action', '/updatependapatan' + id);
            $('#modalTitle').text('Edit Pendapatan');
            $('#produk_id').val(produk_id);
            $('#jumlah_terjual').val(jumlah_terjual);
            $('#total_pendapatan').val(total_pendapatan);
            $('#tanggal').val(tanggal);
            $('#productModal').modal('show');
        });
    });
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Pendapatan</h5>
            <button id="addProductBtn" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Pendapatan</button>
            <form action="{{ route('exportpendapatan') }}" method="GET" class="mt-3">
                <div class="row">
                    <div class="col-md-5">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-5">
                        <label for="end_date">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success mt-4">Export</button>
                    </div>
                </div>
            </form>
            <div class="card mt-3">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Total Pendapatan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($pendapatans as $pendapatan)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pendapatan->user->name }}</td>
                                        <td>{{ $pendapatan->produk->nama_produk }}</td>
                                        <td>{{ $pendapatan->jumlah_terjual }}</td>
                                        <td>{{ number_format($pendapatan->total_pendapatan, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pendapatan->tanggal)->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-light ti ti-dots-vertical" type="button"
                                                    id="menuOptions" data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="border: none; background: none;">
                                                    <i class="ti ti-more" style="font-size: 1.5rem;"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button class="dropdown-item edit-button" 
                                                            data-id="{{ $pendapatan->id }}" 
                                                            data-produk-id="{{ $pendapatan->produk_id }}"
                                                            data-jumlah-terjual="{{ $pendapatan->jumlah_terjual }}"
                                                            data-total-pendapatan="{{ $pendapatan->total_pendapatan }}"
                                                            data-tanggal="{{ $pendapatan->tanggal }}">
                                                            <i class="ti ti-pencil"></i> Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('deletependapatan', $pendapatan->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger delete-button">
                                                                <i class="ti ti-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Pendapatan -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Pendapatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Nama Pengguna</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                    <div class="mb-3">
                        <label for="produk_id">Nama Produk</label>
                        <select name="produk_id" id="produk_id" class="form-control" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Export Pendapatan ke PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('exportpendapatan') }}" method="GET">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="limit">Jumlah Data</label>
                        <select name="limit" id="limit" class="form-control">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="all">Semua</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Export</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
