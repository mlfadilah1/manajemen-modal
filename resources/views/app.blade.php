<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard | Mr. Hoyy')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('template') }}/assets/images/logos/mrhoyy.png" />
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/styles.min.css" />
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('navbar')
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                @yield('content')
                @include('footer')
            </div>
        </div>
    </div>
    <script src="{{ asset('template') }}/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('template') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template') }}/assets/js/sidebarmenu.js"></script>
    <script src="{{ asset('template') }}/assets/js/app.min.js"></script>
    <script src="{{ asset('template') }}/assets/libs/apexcharts/dist/apexcharts.js"></script>
    <script src="{{ asset('template') }}/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="{{ asset('template') }}/assets/js/dashboard.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
    @yield('js')
    @include('sweetalert::alert')
    @stack('myscript')
    <script>
        $(document).ready(function() {
            // ✅ Notifikasi Berhasil
            @if(session('success'))
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            @endif
    
            // ❌ Notifikasi Gagal
            @if(session('error'))
                Swal.fire({
                    title: "Gagal!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "OK"
                });
            @endif
    
            // ⚠️ Notifikasi Validasi Gagal
            @if ($errors->any())
                Swal.fire({
                    title: "Validasi Gagal!",
                    text: "{{ $errors->first() }}",
                    icon: "warning",
                    confirmButtonColor: "#f39c12",
                    confirmButtonText: "OK"
                });
            @endif
        });
    </script>    
</body>

</html>
