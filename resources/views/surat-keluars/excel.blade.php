<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Tujuan Surat</th>
            <th>Perihal</th>
            <th>Jenis Surat</th>
            <th>Tanggal Surat</th>
            <th>Status</th>
            <th>Dibuat Oleh</th>
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
                <td>{{ $surat->status }}</td>
                <td>{{ $surat->user->name ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>