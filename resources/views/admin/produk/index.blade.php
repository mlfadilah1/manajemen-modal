@extends('app')
@section('title','Produk | Mr.Hoyy')
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
            $('#productForm').attr('action', '{{ route('submitproduk') }}');
            $('#modalTitle').text('Tambah Produk');
            $('#productForm')[0].reset();
            $('#productModal').modal('show');
        });

        // Show modal for editing a product
        $('.edit-button').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var harga = $(this).data('harga');
            var biaya = $(this).data('biaya');
            
            $('#productForm').attr('action', '/updateproduk' + id);
            $('#modalTitle').text('Edit Produk');
            $('#nama_produk').val(nama);
            $('#harga_jual').val(harga);
            $('#biaya_produksi').val(biaya);
            $('#productModal').modal('show');
        });
    });
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Produk</h5>
            <button class="btn btn-primary" id="addProductBtn">Tambah Produk</button>
            <div class="table-responsive mt-3">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga Jual</th>
                            <th>Biaya Produksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($produk as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama_produk }}</td>
                                <td>{{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                                <td>{{ number_format($data->biaya_produksi, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-light ti ti-dots-vertical" type="button"
                                            id="menuOptions" data-bs-toggle="dropdown" aria-expanded="false"
                                            style="border: none; background: none;">
                                            <i class="ti ti-more" style="font-size: 1.5rem;"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="menuOptions">
                                            <li>
                                                <button class="dropdown-item edit-button"
                                                data-id="{{ $data->id }}" 
                                                data-nama="{{ $data->nama_produk }}" 
                                                data-harga="{{ $data->harga_jual }}" 
                                                data-biaya="{{ $data->biaya_produksi }}">
                                                <i class="ti ti-pencil"></i> Edit
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('deleteproduk', $data->id) }}" method="POST" style="display:inline;">
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

<!-- Modal Form Tambah/Edit Produk -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id">Nama Pengguna</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                    </div>
                    <div class="mb-3">
                        <label for="biaya_produksi" class="form-label">Biaya Produksi</label>
                        <input type="number" class="form-control" id="biaya_produksi" name="biaya_produksi" required>
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
@endsection
