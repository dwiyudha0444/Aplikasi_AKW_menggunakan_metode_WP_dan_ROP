<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .badge-warning {
            background-color: yellow;
        }
        .badge-success {
            background-color: green;
            color: white;
        }
        .badge-danger {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Laporan Transaksi</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Reseller</th>
                <th>Tanggal Pemesanan</th>
                <th>Status Pemesanan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemesanan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <span class="@if ($item->status_pemesanan == 'Pending') badge-warning
                                     @elseif($item->status_pemesanan == 'Selesai') badge-success
                                     @elseif($item->status_pemesanan == 'Dibatalkan') badge-danger @endif">
                            {{ $item->status_pemesanan }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
