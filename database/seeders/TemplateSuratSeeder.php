<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schema;

class TemplateSuratSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('template_surats')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('template_surats')->insert([
            [
                'nama_template' => 'Perizinan Penelitian',
                'jenis_template' => 'Penelitian',
                'status' => 'aktif',
                'isi_template' => '<p style="text-align: center; font-size: 14pt; font-weight: bold; margin-bottom: 5px; font-family: \'Times New Roman\', serif;">SURAT KETERANGAN PENELITIAN (SKP)</p>
<p style="text-align: center; font-size: 12pt; margin-bottom: 25px; font-family: \'Times New Roman\', serif;">Nomor: {{ nomor_surat }}</p>

<p style="text-align: justify; font-size: 12pt; font-family: \'Times New Roman\', serif; text-indent: 0.5in; margin-bottom: 15px; line-height: 1.5;">
Berdasarkan Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 03 Tahun 2018 tentang Penerbitan Surat Keterangan Penelitian dan Rekomendasi dari Kepala Badan Kesatuan Bangsa dan Politik Kota Bandar Lampung Nomor {{ nomor_rekomendasi }} tanggal {{ tanggal_rekomendasi }}, yang bertandatangan di bawah ini Kepala Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kota Bandar Lampung memberikan Surat Keterangan Penelitian (SKP) kepada:
</p>

<table style="width: 100%; border-collapse: collapse; font-family: \'Times New Roman\', serif; font-size: 12pt; margin-bottom: 20px; margin-left: 20px;">
    <tr>
        <td style="width: 30px; vertical-align: top; padding: 4px 0;">1.</td>
        <td style="width: 200px; vertical-align: top; padding: 4px 0;">Nama</td>
        <td style="width: 15px; vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ nama_pemohon }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">2.</td>
        <td style="vertical-align: top; padding: 4px 0;">Alamat</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ alamat_pemohon }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">3.</td>
        <td style="vertical-align: top; padding: 4px 0;">Judul Penelitian</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ judul_penelitian }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">4.</td>
        <td style="vertical-align: top; padding: 4px 0;">Tujuan Penelitian</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ tujuan_penelitian }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">5.</td>
        <td style="vertical-align: top; padding: 4px 0;">Lokasi Penelitian</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ lokasi_penelitian }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">6.</td>
        <td style="vertical-align: top; padding: 4px 0;">Tanggal dan/atau lamanya penelitian</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ lama_penelitian }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">7.</td>
        <td style="vertical-align: top; padding: 4px 0;">Bidang Penelitian</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ bidang_penelitian }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">8.</td>
        <td style="vertical-align: top; padding: 4px 0;">Status Penelitian</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ status_penelitian }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">9.</td>
        <td style="vertical-align: top; padding: 4px 0;">Nama Penanggung Jawab atau Koordinator</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ penanggung_jawab }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">10.</td>
        <td style="vertical-align: top; padding: 4px 0;">Anggota Penelitian</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ anggota_penelitian }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">11.</td>
        <td style="vertical-align: top; padding: 4px 0;">Nama Badan Hukum, Lembaga dan Organisasi Kemasyarakatan</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ lembaga }}</td>
    </tr>
</table>

<p style="font-size: 12pt; font-family: \'Times New Roman\', serif; font-weight: bold; margin-bottom: 5px;">Dengan ketentuan sebagai berikut:</p>
<ol style="font-size: 12pt; font-family: \'Times New Roman\', serif; margin-bottom: 25px; padding-left: 20px; text-align: justify; line-height: 1.5;">
    <li style="margin-bottom: 4px;">Pelaksanaan penelitian tidak disalahgunakan untuk tujuan tertentu yang dapat mengganggu stabilitas pemerintah.</li>
    <li style="margin-bottom: 4px;">Setelah penelitian selesai, agar menyerahkan hasilnya kepada Badan Kesatuan Bangsa dan Politik Kota Bandar Lampung.</li>
    <li style="margin-bottom: 4px;">Surat Keterangan Penelitian ini berlaku selama {{ lama_penelitian }} sejak tanggal ditetapkan.</li>
</ol>

<table style="width: 100%; border-collapse: collapse; font-family: \'Times New Roman\', serif; font-size: 12pt; margin-top: 30px;">
    <tr>
        <td style="width: 33%; text-align: center; vertical-align: top;">
            <p style="margin: 0 0 10px 0; font-size: 10pt; font-weight: bold;">FOTO PEMOHON</p>
            <div style="border: 1px dashed #000000; width: 113px; height: 151px; line-height: 151px; margin: 0 auto; text-align: center; font-size: 9pt;">
                {{ foto_pemohon_placeholder }}
            </div>
        </td>
        <td style="width: 27%; text-align: center; vertical-align: top;">
            <p style="margin: 0 0 10px 0; font-size: 10pt; font-weight: bold;">QR CODE VERIFIKASI</p>
            <div style="border: 1px dashed #000000; width: 100px; height: 100px; line-height: 100px; margin: 0 auto; text-align: center; font-size: 9pt;">
                {{ qr_code_placeholder }}
            </div>
        </td>
        <td style="width: 40%; text-align: left; vertical-align: top; padding-left: 20px;">
            <p style="margin: 0 0 4px 0;">Ditetapkan di : Bandarlampung</p>
            <p style="margin: 0 0 10px 0;">Pada tanggal : {{ tanggal_penetapan }}</p>
            <p style="margin: 0 0 5px 0; font-weight: bold; text-transform: uppercase; font-size: 10pt; line-height: 1.3;">KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU KOTA BANDAR LAMPUNG</p>
            <div style="border: 1px dashed #000000; width: 180px; height: 70px; line-height: 70px; text-align: center; font-size: 8pt; margin: 10px 0; color: #475569;">
                TANDATANGAN ELEKTRONIK
            </div>
            <p style="margin: 0; font-weight: bold; text-decoration: underline; text-transform: uppercase;">{{ nama_pejabat }}</p>
            <p style="margin: 0;">NIP. {{ nip_pejabat }}</p>
        </td>
    </tr>
</table>

<div style="margin-top: 30px; font-family: \'Times New Roman\', serif; font-size: 11pt;">
    <p style="margin: 0 0 4px 0; font-weight: bold; text-decoration: underline;">Tembusan :</p>
    <ol style="margin: 0; padding-left: 15px;">
        <li>BAPENASBANG Kota Bandar Lampung</li>
        <li>Bappeda Kota Bandar Lampung</li>
        <li>Pertinggal</li>
    </ol>
</div>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_template' => 'Perizinan Buka Praktek Kesehatan',
                'jenis_template' => 'Kesehatan',
                'status' => 'aktif',
                'isi_template' => '<p style="text-align: center; font-size: 14pt; font-weight: bold; margin-bottom: 5px; font-family: \'Times New Roman\', serif;">SURAT IZIN PRAKTEK KESEHATAN</p>
<p style="text-align: center; font-size: 12pt; margin-bottom: 25px; font-family: \'Times New Roman\', serif;">Nomor: {{ nomor_surat }}</p>

<p style="text-align: justify; font-size: 12pt; font-family: \'Times New Roman\', serif; text-indent: 0.5in; margin-bottom: 15px; line-height: 1.5;">
Berdasarkan ketentuan peraturan perundang-undangan yang berlaku serta hasil verifikasi administrasi permohonan izin praktek kesehatan, Kepala Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kota Bandar Lampung memberikan izin praktek kesehatan kepada:
</p>

<table style="width: 100%; border-collapse: collapse; font-family: \'Times New Roman\', serif; font-size: 12pt; margin-bottom: 20px; margin-left: 20px;">
    <tr>
        <td style="width: 30px; vertical-align: top; padding: 4px 0;">1.</td>
        <td style="width: 200px; vertical-align: top; padding: 4px 0;">Nama Pemohon</td>
        <td style="width: 15px; vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ nama_pemohon }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">2.</td>
        <td style="vertical-align: top; padding: 4px 0;">Alamat Pemohon</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ alamat_pemohon }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">3.</td>
        <td style="vertical-align: top; padding: 4px 0;">Profesi Kesehatan</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ profesi_kesehatan }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">4.</td>
        <td style="vertical-align: top; padding: 4px 0;">Nomor STR</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ nomor_str }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">5.</td>
        <td style="vertical-align: top; padding: 4px 0;">Nomor SIP</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ nomor_sip }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">6.</td>
        <td style="vertical-align: top; padding: 4px 0;">Tempat Praktek</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ tempat_praktek }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">7.</td>
        <td style="vertical-align: top; padding: 4px 0;">Alamat/Lokasi Praktek</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ lokasi_praktek }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">8.</td>
        <td style="vertical-align: top; padding: 4px 0;">Hari dan Jam Praktek</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ jadwal_praktek }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">9.</td>
        <td style="vertical-align: top; padding: 4px 0;">Masa Berlaku Izin</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ masa_berlaku }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">10.</td>
        <td style="vertical-align: top; padding: 4px 0;">Keterangan</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ keterangan_izin }}</td>
    </tr>
</table>

<p style="font-size: 12pt; font-family: \'Times New Roman\', serif; font-weight: bold; margin-bottom: 5px;">Dengan ketentuan sebagai berikut:</p>
<ol style="font-size: 12pt; font-family: \'Times New Roman\', serif; margin-bottom: 25px; padding-left: 20px; text-align: justify; line-height: 1.5;">
    <li style="margin-bottom: 4px;">Pemegang izin wajib menjalankan praktek sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.</li>
    <li style="margin-bottom: 4px;">Izin ini tidak dapat dipindahtangankan kepada pihak lain.</li>
    <li style="margin-bottom: 4px;">Pemegang izin wajib menjaga etika profesi, standar pelayanan, dan keselamatan masyarakat.</li>
    <li style="margin-bottom: 4px;">Apabila terdapat perubahan tempat praktek, jadwal praktek, atau data pemohon, maka wajib melaporkan kepada DPMPTSP Kota Bandar Lampung.</li>
    <li style="margin-bottom: 4px;">Izin ini berlaku sampai dengan {{ masa_berlaku }} dan dapat diperpanjang sesuai ketentuan yang berlaku.</li>
    <li style="margin-bottom: 4px;">Apabila di kemudian hari terdapat kekeliruan dalam surat izin ini, maka akan dilakukan perbaikan sebagaimana mestinya.</li>
</ol>

<table style="width: 100%; border-collapse: collapse; font-family: \'Times New Roman\', serif; font-size: 12pt; margin-top: 30px;">
    <tr>
        <td style="width: 40%; text-align: center; vertical-align: top;">
            <p style="margin: 0 0 10px 0; font-size: 10pt; font-weight: bold;">QR CODE VERIFIKASI</p>
            <div style="border: 1px dashed #000000; width: 100px; height: 100px; line-height: 100px; margin: 0 auto; text-align: center; font-size: 9pt;">
                {{ qr_code_placeholder }}
            </div>
        </td>
        <td style="width: 20%;"></td>
        <td style="width: 40%; text-align: left; vertical-align: top; padding-left: 20px;">
            <p style="margin: 0 0 4px 0;">Ditetapkan di : Bandarlampung</p>
            <p style="margin: 0 0 10px 0;">Pada tanggal : {{ tanggal_penetapan }}</p>
            <p style="margin: 0 0 5px 0; font-weight: bold; text-transform: uppercase; font-size: 10pt; line-height: 1.3;">KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU KOTA BANDAR LAMPUNG</p>
            <div style="border: 1px dashed #000000; width: 180px; height: 70px; line-height: 70px; text-align: center; font-size: 8pt; margin: 10px 0; color: #475569;">
                TANDATANGAN ELEKTRONIK
            </div>
            <p style="margin: 0; font-weight: bold; text-decoration: underline; text-transform: uppercase;">{{ nama_pejabat }}</p>
            <p style="margin: 0;">NIP. {{ nip_pejabat }}</p>
        </td>
    </tr>
</table>

<div style="margin-top: 30px; font-family: \'Times New Roman\', serif; font-size: 11pt;">
    <p style="margin: 0 0 4px 0; font-weight: bold; text-decoration: underline;">Tembusan :</p>
    <ol style="margin: 0; padding-left: 15px;">
        <li>Dinas Kesehatan Kota Bandar Lampung</li>
        <li>Organisasi Profesi terkait</li>
        <li>Pertinggal</li>
    </ol>
</div>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_template' => 'Perizinan Pembangunan',
                'jenis_template' => 'Pembangunan',
                'status' => 'aktif',
                'isi_template' => '<p style="text-align: center; font-size: 14pt; font-weight: bold; margin-bottom: 5px; font-family: \'Times New Roman\', serif;">SURAT IZIN PEMBANGUNAN</p>
<p style="text-align: center; font-size: 12pt; margin-bottom: 25px; font-family: \'Times New Roman\', serif;">Nomor: {{ nomor_surat }}</p>

<p style="text-align: justify; font-size: 12pt; font-family: \'Times New Roman\', serif; text-indent: 0.5in; margin-bottom: 15px; line-height: 1.5;">
Berdasarkan hasil verifikasi administrasi dan teknis atas permohonan izin pembangunan serta memperhatikan ketentuan peraturan perundang-undangan yang berlaku, Kepala Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kota Bandar Lampung memberikan izin pembangunan kepada:
</p>

<table style="width: 100%; border-collapse: collapse; font-family: \'Times New Roman\', serif; font-size: 12pt; margin-bottom: 20px; margin-left: 20px;">
    <tr>
        <td style="width: 30px; vertical-align: top; padding: 4px 0;">1.</td>
        <td style="width: 200px; vertical-align: top; padding: 4px 0;">Nama Pemohon</td>
        <td style="width: 15px; vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ nama_pemohon }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">2.</td>
        <td style="vertical-align: top; padding: 4px 0;">Alamat Pemohon</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ alamat_pemohon }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">3.</td>
        <td style="vertical-align: top; padding: 4px 0;">Nomor Identitas</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ nomor_identitas }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">4.</td>
        <td style="vertical-align: top; padding: 4px 0;">Jenis Bangunan</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ jenis_bangunan }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">5.</td>
        <td style="vertical-align: top; padding: 4px 0;">Peruntukan Bangunan</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ peruntukan_bangunan }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">6.</td>
        <td style="vertical-align: top; padding: 4px 0;">Lokasi Bangunan</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ lokasi_bangunan }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">7.</td>
        <td style="vertical-align: top; padding: 4px 0;">Luas Tanah</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ luas_tanah }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">8.</td>
        <td style="vertical-align: top; padding: 4px 0;">Luas Bangunan</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ luas_bangunan }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">9.</td>
        <td style="vertical-align: top; padding: 4px 0;">Jumlah Lantai</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ jumlah_lantai }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">10.</td>
        <td style="vertical-align: top; padding: 4px 0;">Status Tanah</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ status_tanah }}</td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 4px 0;">11.</td>
        <td style="vertical-align: top; padding: 4px 0;">Keterangan Izin</td>
        <td style="vertical-align: top; padding: 4px 0;">:</td>
        <td style="vertical-align: top; padding: 4px 0;">{{ keterangan_izin }}</td>
    </tr>
</table>

<p style="font-size: 12pt; font-family: \'Times New Roman\', serif; font-weight: bold; margin-bottom: 5px;">Dengan ketentuan sebagai berikut:</p>
<ol style="font-size: 12pt; font-family: \'Times New Roman\', serif; margin-bottom: 25px; padding-left: 20px; text-align: justify; line-height: 1.5;">
    <li style="margin-bottom: 4px;">Pelaksanaan pembangunan wajib mengikuti ketentuan tata ruang, teknis bangunan, dan peraturan perundang-undangan yang berlaku.</li>
    <li style="margin-bottom: 4px;">Pemegang izin bertanggung jawab penuh terhadap pelaksanaan pembangunan di lokasi yang telah ditetapkan.</li>
    <li style="margin-bottom: 4px;">Izin ini tidak dapat dipindahtangankan kepada pihak lain tanpa persetujuan dari instansi yang berwenang.</li>
    <li style="margin-bottom: 4px;">Apabila terdapat perubahan bentuk, fungsi, luas, atau lokasi bangunan, pemegang izin wajib melaporkan kepada DPMPTSP Kota Bandar Lampung.</li>
    <li style="margin-bottom: 4px;">Apabila di kemudian hari terdapat data yang tidak benar atau tidak sesuai dengan ketentuan, izin ini dapat ditinjau kembali sesuai peraturan yang berlaku.</li>
    <li style="margin-bottom: 4px;">Surat izin ini berlaku selama {{ masa_berlaku }} sejak tanggal ditetapkan.</li>
</ol>

<table style="width: 100%; border-collapse: collapse; font-family: \'Times New Roman\', serif; font-size: 12pt; margin-top: 30px;">
    <tr>
        <td style="width: 40%; text-align: center; vertical-align: top;">
            <p style="margin: 0 0 10px 0; font-size: 10pt; font-weight: bold;">QR CODE VERIFIKASI</p>
            <div style="border: 1px dashed #000000; width: 100px; height: 100px; line-height: 100px; margin: 0 auto; text-align: center; font-size: 9pt;">
                {{ qr_code_placeholder }}
            </div>
        </td>
        <td style="width: 20%;"></td>
        <td style="width: 40%; text-align: left; vertical-align: top; padding-left: 20px;">
            <p style="margin: 0 0 4px 0;">Ditetapkan di : Bandarlampung</p>
            <p style="margin: 0 0 10px 0;">Pada tanggal : {{ tanggal_penetapan }}</p>
            <p style="margin: 0 0 5px 0; font-weight: bold; text-transform: uppercase; font-size: 10pt; line-height: 1.3;">KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU KOTA BANDAR LAMPUNG</p>
            <div style="border: 1px dashed #000000; width: 180px; height: 70px; line-height: 70px; text-align: center; font-size: 8pt; margin: 10px 0; color: #475569;">
                TANDATANGAN ELEKTRONIK
            </div>
            <p style="margin: 0; font-weight: bold; text-decoration: underline; text-transform: uppercase;">{{ nama_pejabat }}</p>
            <p style="margin: 0;">NIP. {{ nip_pejabat }}</p>
        </td>
    </tr>
</table>

<div style="margin-top: 30px; font-family: \'Times New Roman\', serif; font-size: 11pt;">
    <p style="margin: 0 0 4px 0; font-weight: bold; text-decoration: underline;">Tembusan :</p>
    <ol style="margin: 0; padding-left: 15px;">
        <li>Dinas Perumahan dan Kawasan Permukiman Kota Bandar Lampung</li>
        <li>Dinas Pekerjaan Umum Kota Bandar Lampung</li>
        <li>Camat setempat</li>
        <li>Lurah setempat</li>
        <li>Pertinggal</li>
    </ol>
</div>',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
