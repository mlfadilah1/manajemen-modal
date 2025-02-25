@extends('app')
@section('title','User | Mr.Hoyy')
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

        // Show modal for adding a user
        $('#addProductBtn').click(function() {
            $('#productForm').attr('action', '{{ route('submituser') }}');
            $('#modalTitle').text('Tambah User');
            $('#productForm')[0].reset();
            $('#methodField').html(''); // Hapus method PUT jika ada
            $('#productModal').modal('show');
        });

        // Show modal for editing a user
        $('.edit-button').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var role = $(this).data('role');

            $('#productForm').attr('action', '/updateuser' + id);
            $('#modalTitle').text('Edit User');
            $('#name').val(name);
            $('#email').val(email);
            $('#role').val(role);

            // Tambahkan method PUT untuk edit
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
            <h5 class="card-title fw-semibold mb-4">User</h5>
            <button id="addProductBtn" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah User</button>
            <div class="card">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @isset($users)
                                    @foreach ($users as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->role }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-light ti ti-dots-vertical" type="button"
                                                        id="menuOptions" data-bs-toggle="dropdown" aria-expanded="false"
                                                        style="border: none; background: none;">
                                                        <i class="ti ti-more" style="font-size: 1.5rem;"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="menuOptions">
                                                        {{-- <li>
                                                            <a href="#" class="dropdown-item edit-button"
                                                                data-id="{{ $data->id }}" 
                                                                data-name="{{ $data->name }}" 
                                                                data-email="{{ $data->email }}" 
                                                                data-role="{{ $data->role }}">
                                                                <i class="ti ti-pencil"></i> Edit
                                                            </a>
                                                        </li> --}}
                                                        <li>
                                                            <form action="{{ route('deleteuser', $data->id) }}" method="POST">
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
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit User -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" method="POST">
                    @csrf
                    <div id="methodField"></div> <!-- Tempat untuk method PUT saat edit -->

                    <div class="mb-3">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama..." required />
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email..." required />
                    </div>
                    <div class="mb-3">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" id="role" name="role" value="Staff" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password..." required />
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
