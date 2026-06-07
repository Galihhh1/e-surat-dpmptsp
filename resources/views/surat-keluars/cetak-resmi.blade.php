<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Resmi - {{ $suratKeluar->nomor_surat }}</title>
    <style>
        /* PDF Page Setup */
        @page {
            size: A4;
            margin: 2cm 2.5cm 2cm 2.5cm;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000000;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat (Header) */
        .kop-container {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .kop-logo-td {
            width: 12%;
            vertical-align: middle;
            text-align: center;
        }
        .kop-text-td {
            width: 88%;
            text-align: center;
            vertical-align: middle;
        }
        .kop-logo-placeholder {
            width: 55px;
            height: 55px;
            border: 2px solid #000000;
            border-radius: 50%;
            display: inline-block;
            text-align: center;
            line-height: 55px;
            font-size: 8pt;
            font-weight: bold;
            font-family: Arial, sans-serif;
        }
        .kop-title-1 {
            font-family: Arial, sans-serif;
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            line-height: 1.2;
        }
        .kop-title-2 {
            font-family: Arial, sans-serif;
            font-size: 15pt;
            font-weight: bold;
            margin: 2px 0 0 0;
            text-transform: uppercase;
            line-height: 1.2;
            letter-spacing: 0.5px;
        }
        .kop-sub {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            margin: 4px 0 0 0;
            line-height: 1.3;
        }

        .line-double {
            border-bottom: 4px double #000000;
            height: 1px;
            margin-bottom: 25px;
            margin-top: 5px;
        }

        /* Letter Body Content */
        .surat-content {
            margin-top: 10px;
        }
        
        /* Table helper within letter content */
        .surat-content table {
            width: 100%;
            margin-left: 15px;
            margin-bottom: 15px;
            border-collapse: collapse;
        }
        .surat-content table td {
            padding: 3px 5px;
            vertical-align: top;
        }

        /* Signature block */
        .ttd-table {
            width: 100%;
            margin-top: 50px;
            border-collapse: collapse;
        }
        .ttd-table td {
            padding: 0;
            vertical-align: top;
        }
        .ttd-block {
            width: 250px;
            text-align: center;
            float: right;
        }
        .ttd-title {
            margin-bottom: 65px;
        }
        .ttd-name {
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            margin: 0;
        }
        .ttd-nip {
            font-size: 10.5pt;
            margin: 2px 0 0 0;
        }
    </style>
</head>
<body>

    <!-- Header Kop Surat Dinas -->
    <table class="kop-container">
        <tr>
            <td class="kop-logo-td">
                <!-- Text-based high fidelity seal placeholder for robust PDF conversion without local server file resolution errors -->
                <div class="kop-logo-placeholder">JATIM</div>
            </td>
            <td class="kop-text-td">
                <h4 class="kop-title-1">PEMERINTAH PROVINSI JAWA TIMUR</h4>
                <h3 class="kop-title-2">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</h3>
                <p class="kop-sub">
                    Jl. Satelit Indah II No. 1, Surabaya, Jawa Timur 60188<br>
                    Telp. (031) 7345678 | Fax. (031) 7345679 | Email: dpmptsp@jatimprov.go.id
                </p>
            </td>
        </tr>
    </table>
    
    <!-- Double Divider Line -->
    <div class="line-double"></div>

    <!-- Letter Content -->
    <div class="surat-content">
        {!! $suratKeluar->isi_surat !!}
    </div>

    <!-- Signature block aligned using standard PDF table method -->
    <table class="ttd-table">
        <tr>
            <td style="width: 55%;"></td>
            <td style="width: 45%;">
                <div class="ttd-block">
                    <p class="ttd-title">Kepala Dinas DPMPTSP Provinsi Jawa Timur,</p>
                    <p class="ttd-name">Drs. H. M. Alimudin, M.Si</p>
                    <p class="ttd-nip">NIP. 19740512 200212 1 002</p>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
