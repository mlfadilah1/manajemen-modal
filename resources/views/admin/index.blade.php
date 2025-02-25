@extends('app')

@section('title', 'Dashboard | Mr.Hoyy')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title fw-semibold">Analisis Pendapatan</h5>
                    <form method="GET" action="{{ route('home') }}" class="mb-0">
                        <label for="periode">Pilih Periode:</label>
                        <input type="month" id="periode" name="periode" value="{{ $periode }}" onchange="this.form.submit()">
                    </form>
                    <button onclick="exportToPDF()" class="btn btn-primary">Export to PDF</button>
                    {{-- <button onclick="exportToExcel()" class="btn btn-success">Export to Excel</button> --}}
                </div>
                <div class="d-flex justify-content-between gap-3">
                    <div style="width: 48%;">
                        <canvas id="chartUnitROI"></canvas>
                    </div>
                    <div style="width: 48%;">
                        <canvas id="chartRupiahLaba"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Kanan -->
    <div class="col-lg-4">
        <div class="row">
            <!-- Yearly Breakup -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Yearly Breakup</h5>
                        <h4 class="fw-semibold">$36,358</h4>
                        <div class="d-flex align-items-center">
                            <span class="me-2 rounded-circle bg-light-success d-flex align-items-center justify-content-center">
                                <i class="ti ti-arrow-up-left text-success"></i>
                            </span>
                            <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                            <p class="fs-3 mb-0">last year</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Earnings -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Monthly Earnings</h5>
                        <h4 class="fw-semibold">$6,820</h4>
                        <div class="d-flex align-items-center">
                            <span class="me-2 rounded-circle bg-light-danger d-flex align-items-center justify-content-center">
                                <i class="ti ti-arrow-down-right text-danger"></i>
                            </span>
                            <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                            <p class="fs-3 mb-0">last year</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx1 = document.getElementById("chartUnitROI").getContext("2d");
        var ctx2 = document.getElementById("chartRupiahLaba").getContext("2d");

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [
                    { label: 'BEP Unit', data: {!! json_encode($chartData['datasets'][0]['data']) !!}, backgroundColor: '#2E86C1', borderRadius: 5 },
                    { label: 'ROI', data: {!! json_encode($chartData['datasets'][3]['data']) !!}, backgroundColor: '#DC7633', borderRadius: 5 }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'top' }, tooltip: { enabled: true }},
                scales: { y: { beginAtZero: true } }
            }
        });

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [
                    { label: 'BEP Rupiah', data: {!! json_encode($chartData['datasets'][1]['data']) !!}, backgroundColor: '#2E86C1', borderRadius: 5 },
                    { label: 'Laba Bersih', data: {!! json_encode($chartData['datasets'][2]['data']) !!}, backgroundColor: '#DC7633', borderRadius: 5 }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'top' }, tooltip: { enabled: true }},
                scales: { y: { beginAtZero: true } }
            }
        });
    });

    function exportToPDF() {
            const {
                jsPDF
            } = window.jspdf;
            const pdf = new jsPDF();
            pdf.text("Analisis Pendapatan", 10, 10);
            pdf.addImage(document.getElementById("chartUnitROI"), 'PNG', 10, 20, 180, 80);
            pdf.addImage(document.getElementById("chartRupiahLaba"), 'PNG', 10, 110, 180, 80);
            pdf.save("Analisis_Pendapatan.pdf");
        }

    // function exportToExcel() {
    //     let wb = XLSX.utils.book_new();
    //     let ws_data = [
    //         ["Kategori", "BEP Unit", "ROI", "BEP Rupiah", "Laba Bersih"],
    //         ...{!! json_encode($chartData['labels']) !!}.map((label, index) => [
    //             label,
    //             {!! json_encode($chartData['datasets'][0]['data']) !!}[index],
    //             {!! json_encode($chartData['datasets'][3]['data']) !!}[index],
    //             {!! json_encode($chartData['datasets'][1]['data']) !!}[index],
    //             {!! json_encode($chartData['datasets'][2]['data']) !!}[index]
    //         ])
    //     ];
    //     let ws = XLSX.utils.aoa_to_sheet(ws_data);
    //     XLSX.utils.book_append_sheet(wb, ws, "Analisis Pendapatan");
    //     XLSX.writeFile(wb, "Analisis_Pendapatan.xlsx");
    // }
</script>

@endsection
