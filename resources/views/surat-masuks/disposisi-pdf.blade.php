<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lembar Disposisi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .no-border td {
            border: none;
            padding: 4px;
        }

        .signature {
            margin-top: 50px;
            width: 100%;
        }

        .signature td {
            border: none;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h3>DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</h3>
        <p>KOTA BANDAR LAMPUNG</p>
        <p>LEMBAR DISPOSISI SURAT MASUK</p>
    </div>

    <div class="title">
        LEMBAR DISPOSISI
    </div>

    <table>
        <tr>
            <td width="30%"><strong>Nomor Surat</strong></td>
            <td>{{ $suratMasuk->nomor_surat }}</td>
        </tr>
        <tr>
            <td><strong>Pengirim</strong></td>
            <td>{{ $suratMasuk->pengirim }}</td>
        </tr>
        <tr>
            <td><strong>Perihal</strong></td>
            <td>{{ $suratMasuk->perihal }}</td>
        </tr>
        <tr>
            <td><strong>Jenis Surat</strong></td>
            <td>{{ $suratMasuk->jenis_surat }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Surat</strong></td>
            <td>{{ $suratMasuk->tanggal_surat }}</td>
        </tr>
        <tr>
            <td><strong>Bidang Tujuan</strong></td>
            <td>{{ $suratMasuk->bidang->nama_bidang ?? 'Belum Didisposisikan' }}</td>
        </tr>
        <tr>
            <td><strong>Catatan Disposisi</strong></td>
            <td>{{ $suratMasuk->catatan_disposisi ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Status</strong></td>
            <td>{{ ucfirst($suratMasuk->status) }}</td>
        </tr>
    </table>

    <br>

    <table>
        <tr>
            <th>Histori / Catatan Disposisi</th>
        </tr>

        @forelse($suratMasuk->historiSurats as $histori)
            <tr>
                <td>
                    <strong>{{ $histori->aktivitas }}</strong><br>
                    {{ $histori->keterangan }}<br>
                    <small>
                        Oleh: {{ $histori->user->name ?? '-' }}
                        |
                        {{ $histori->created_at->format('d-m-Y H:i') }}
                    </small>
                </td>
            </tr>
        @empty
            <tr>
                <td>Belum ada histori disposisi.</td>
            </tr>
        @endforelse
    </table>

    <table class="signature">
        <tr>
            <td></td>
            <td>
                Bandar Lampung, {{ now()->format('d-m-Y') }}<br>
                Admin Tata Usaha
                <br><br><br><br>
                ______________________
            </td>
        </tr>
    </table>

</body>
</html>