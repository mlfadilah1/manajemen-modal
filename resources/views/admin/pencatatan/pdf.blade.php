<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Pendapatan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .header-left img {
            width: 100px; /* Ukuran logo perusahaan */
            margin-right: 20px;
        }

        .company-info {
            font-size: 14px;
        }

        .company-info h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .company-info p {
            margin: 0;
            text-align: center;
        }

        .header-right {
            text-align: center;
            width: 100%;
        }

        .header-right h1 {
            font-size: 24px;
            margin: 0;
        }

        .header-right p {
            font-size: 16px;
            margin: 5px 0;
        }

        .sub-header {
            text-align: right;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total {
            margin-top: 30px;
            font-size: 16px;
            font-weight: bold;
            text-align: right;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            left: 20px;
            font-size: 12px;
            color: #888;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section with Logo and Company Info -->
        <div class="header">
            <div class="header-left">
                <img src="{{ public_path('path_to_logo/logo.png') }}" alt="Logo Perusahaan"> <!-- Ganti path ke logo perusahaan -->
            </div>
            <div class="header-right">
                <div class="company-info">
                    <h2>Mr. Hoyy</h2>
                    <p>Jl. Genteng</p>
                    <p>Email: ohoy961@gmail.com</p>
                    <p>Telepon: 089691398010</p>
                </div>
            </div>
        </div>

        <h1>Export Laporan Pendapatan</h1>
        <p>Dari: {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} sampai {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</p>

        <!-- Sub-header with print date -->
        <div class="sub-header">
            <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
        </div>

        <!-- Table Section -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Terjual</th>
                    <th>Total Pendapatan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($pendapatans as $pendapatan)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $pendapatan->user->name }}</td>
                        <td>{{ $pendapatan->produk->nama_produk }}</td>
                        <td>{{ $pendapatan->jumlah_terjual }}</td>
                        <td>{{ number_format($pendapatan->total_pendapatan, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($pendapatan->tanggal)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Pendapatan Section -->
        <div class="total">
            <p><strong>Total Pendapatan: </strong>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }} Oleh: {{ Auth::user()->name }}</p>
    </div>
</body>
</html>
