<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Surat Masuk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
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
            font-size: 12px;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Laporan Surat Masuk</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Pengirim</th>
                <th>Perihal</th>
                <th>Bidang</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>

            @foreach($suratMasuks as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nomor_surat }}</td>

                    <td>{{ $item->pengirim }}</td>

                    <td>{{ $item->perihal }}</td>

                    <td>
                        {{ $item->bidang->nama_bidang ?? '-' }}
                    </td>

                    <td>{{ $item->status }}</td>

                    <td>{{ $item->tanggal_surat }}</td>
                </tr>

            @endforeach

        </tbody>
    </table>

</body>
</html>