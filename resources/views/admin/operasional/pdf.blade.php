<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Biaya Operasional</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .container { width: 90%; margin: auto; }
        .header { display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .header-left img { max-width: 100px; height: auto; }
        .company-info { text-align: center; }
        h2, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <img src="{{ public_path('path_to_logo/logo.png') }}" alt="Logo Perusahaan">
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

        <h2>Laporan Biaya Operasional</h2>
        <p><strong>Periode:</strong> {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>
        <p><strong>Tipe Biaya:</strong> {{ $tipe ? ucfirst($tipe) : 'Semua' }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Biaya</th>
                    <th>Jumlah</th>
                    <th>Tipe</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse ($operasional as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->jenis_biaya }}</td>
                        <td>Rp {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($data->tipe) }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data tersedia untuk periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <h3>Total Biaya:</h3>
        @if ($tipe == 'tetap')
            <p><strong>Total Tetap:</strong> Rp {{ number_format($totalTetap, 0, ',', '.') }}</p>
        @elseif ($tipe == 'variabel')
            <p><strong>Total Variabel:</strong> Rp {{ number_format($totalVariabel, 0, ',', '.') }}</p>
        @else
            <p><strong>Total Tetap:</strong> Rp {{ number_format($totalTetap, 0, ',', '.') }}</p>
            <p><strong>Total Variabel:</strong> Rp {{ number_format($totalVariabel, 0, ',', '.') }}</p>
            <p><strong>Total Keseluruhan:</strong> Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</p>
        @endif
        <p class="text-center">Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }} Oleh: {{ Auth::user()->name }}</p>
    </div>
</body>
</html>