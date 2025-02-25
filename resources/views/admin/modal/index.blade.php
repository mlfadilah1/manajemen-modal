@extends('app')
@section('title','Modal | Mr.Hoyy')
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
            $('#productForm').attr('action', '{{ route('submitmodal') }}');
            $('#modalTitle').text('Tambah Modal');
            $('#productForm')[0].reset();
            $('#productModal').modal('show');
        });

        // Show modal for editing a product
        $('.edit-button').click(function() {
            var id = $(this).data('id');
            var nama_usaha = $(this).data('nama-usaha');
            var jumlah_modal = $(this).data('jumlah-modal');
            var tanggal = $(this).data('tanggal');

            $('#productForm').attr('action', '/updatemodal' + id);
            $('#modalTitle').text('Edit Modal');
            $('#nama_usaha').val(nama_usaha);
            $('#jumlah_modal').val(jumlah_modal);
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
            <h5 class="card-title fw-semibold mb-4">Modal</h5>
            <button id="addProductBtn" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Modal</button>
            <div class="card">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengguna</th>
                                    <th>Nama Usaha</th>
                                    <th>Jumlah Modal</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($modals)
                                    @foreach ($modals as $modal)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $modal->user->name }}</td> <!-- Nama pengguna -->
                                            <td>{{ $modal->nama_usaha }}</td>
                                            <td>{{ number_format($modal->jumlah_modal, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($modal->tanggal)->format('d-m-Y') }}</td>
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
                                                                data-id="{{ $modal->id }}"
                                                                data-nama-usaha="{{ $modal->nama_usaha }}"
                                                                data-jumlah-modal="{{ $modal->jumlah_modal }}"
                                                                data-tanggal="{{ $modal->tanggal }}">
                                                                <i class="ti ti-pencil"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('deleteuser', $modal->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger delete-button">
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

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Modal</h5>
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
                        <label for="nama_usaha">Nama Usaha</label>
                        <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_modal" class="form-label">Jumlah Modal</label>
                        <input type="text" class="form-control" id="jumlah_modal" name="jumlah_modal" required>
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
@endsection