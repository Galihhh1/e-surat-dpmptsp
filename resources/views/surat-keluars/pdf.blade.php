<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Surat Keluar</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Laporan Surat Keluar</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Tujuan Surat</th>
                <th>Perihal</th>
                <th>Jenis Surat</th>
                <th>Tanggal Surat</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($suratKeluars as $surat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $surat->nomor_surat }}</td>
                    <td>{{ $surat->tujuan_surat }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td>{{ $surat->jenis_surat }}</td>
                    <td>{{ $surat->tanggal_surat }}</td>
                    <td>{{ ucfirst($surat->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>