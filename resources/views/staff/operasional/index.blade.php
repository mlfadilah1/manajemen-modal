@extends('app')
@section('title','Operasional | Mr.Hoyy')
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
            $('#productForm').attr('action', '{{ route('submitoperasional') }}');
            $('#modalTitle').text('Tambah Operasional');
            $('#productForm')[0].reset();
            $('#productModal').modal('show');
        });

        // Show modal for editing a product
        $('.edit-button').click(function() {
            var id = $(this).data('id');
            var jenis_biaya = $(this).data('jenis');
            var jumlah = $(this).data('jumlah');
            var tipe = $(this).data('tipe');
            var tanggal = $(this).data('tanggal');

            $('#productForm').attr('action', '/updateoperasional' + id);
            $('#modalTitle').text('Edit Operasional');
            $('#jenis_biaya').val(jenis_biaya);
            $('#jumlah').val(jumlah);
            $('#tipe').val(tipe);
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
            <h5 class="card-title fw-semibold mb-4">Biaya Operasional</h5>
            <button id="addProductBtn" class="btn btn-primary">Tambah Operasional</button>
            <br><br>
            <form action="{{ route('exportoperasional') }}" method="GET" target="_blank">
                <div class="row">
                    <div class="col-md-4">
                        <label for="start_date">Dari Tanggal:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="end_date">Sampai Tanggal:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="tipe">Tipe:</label>
                        <select name="tipe" id="tipe" class="form-control">
                            <option value="">Semua</option>
                            <option value="tetap">Tetap</option>
                            <option value="variabel">Variabel</option>
                        </select>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-danger"><i class="ti ti-file"></i>PDF</button>
                    </div>
                </div>
            </form>            
            <div class="card mt-3">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Biaya</th>
                                    <th>Jumlah</th>
                                    <th>Tipe</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($biaya_operasional as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        <td>{{ $data->jenis_biaya }}</td>
                                        <td>{{ number_format($data->jumlah, 0, ',', '.') }}</td>
                                        <td>{{ ucfirst($data->tipe) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
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
                                                            data-jenis="{{ $data->jenis_biaya }}"
                                                            data-jumlah="{{ $data->jumlah }}"
                                                            data-tipe="{{ $data->tipe }}"
                                                            data-tanggal="{{ $data->tanggal }}">
                                                            <i class="ti ti-pencil"></i> Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('deleteoperasional', ['id' => $data->id]) }}" method="POST">
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
                <h5 class="modal-title" id="modalTitle">Tambah Operasional</h5>
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