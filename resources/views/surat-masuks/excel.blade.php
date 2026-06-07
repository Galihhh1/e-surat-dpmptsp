<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Pengirim</th>
            <th>Perihal</th>
            <th>Jenis Surat</th>
            <th>Tanggal Surat</th>
            <th>Bidang</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($suratMasuks as $surat)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $surat->nomor_surat }}</td>
                <td>{{ $surat->pengirim }}</td>
                <td>{{ $surat->perihal }}</td>
                <td>{{ $surat->jenis_surat }}</td>
                <td>{{ $surat->tanggal_surat }}</td>
                <td>{{ $surat->bidang->nama_bidang ?? '-' }}</td>
                <td>{{ $surat->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>