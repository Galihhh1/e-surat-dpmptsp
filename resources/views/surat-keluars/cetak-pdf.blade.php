<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Resmi - {{ $suratKeluar->nomor_surat }}</title>
    <style>
        /* PDF Page Setup */
        @page {
            size: A4;
            margin: 2cm 2cm 2cm 2.5cm;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000000;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat */
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
            width: 50px;
            height: 50px;
            border: 2px solid #000000;
            border-radius: 50%;
            display: inline-block;
            text-align: center;
            line-height: 50px;
            font-size: 8pt;
            font-weight: bold;
            font-family: Arial, sans-serif;
        }
        .kop-title-1 {
            font-family: Arial, sans-serif;
            font-size: 13pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            line-height: 1.2;
        }
        .kop-title-2 {
            font-family: Arial, sans-serif;
            font-size: 14pt;
            font-weight: bold;
            margin: 2px 0 0 0;
            text-transform: uppercase;
            line-height: 1.2;
            letter-spacing: 0.5px;
        }
        .kop-sub {
            font-family: Arial, sans-serif;
            font-size: 8.5pt;
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
        .surat-content p {
            margin-top: 0;
            margin-bottom: 12px;
            text-align: justify;
        }
        
        /* Table formatting inside compiled letter content */
        .surat-content table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }
        .surat-content table td {
            padding: 3px 5px;
            vertical-align: top;
        }

        /* Lists inside content */
        .surat-content ol, .surat-content ul {
            margin-top: 0;
            margin-bottom: 15px;
            padding-left: 20px;
        }
        .surat-content li {
            margin-bottom: 4px;
            text-align: justify;
        }
    </style>
</head>
<body>

    <!-- Header Kop Surat Dinas Bandar Lampung -->
    <table class="kop-container">
        <tr>
            <td class="kop-logo-td">
                <div class="kop-logo-placeholder">LOGO</div>
            </td>
            <td class="kop-text-td">
                <h4 class="kop-title-1">PEMERINTAH KOTA BANDARLAMPUNG</h4>
                <h3 class="kop-title-2">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</h3>
                <p class="kop-sub">
                    Jalan Dr. Susilo Nomor 2 Bandarlampung, Telepon (0721) 476362<br>
                    Faksimile (0721) 476362<br>
                    Website: www.dpmptsp.bandarlampungkota.go.id | Pos-el: dpmptsp.kota@bandarlampungkota.go.id
                </p>
            </td>
        </tr>
    </table>
    
    <!-- Double Divider Line -->
    <div class="line-double"></div>

    <!-- Letter Content -->
    <div class="surat-content">
        @php
            $isiSurat = $suratKeluar->isi_surat;
            try {
                $qrUrl = url('/validasi-surat?nomor_surat=' . urlencode($suratKeluar->nomor_surat));
                
                // For PDF, simple-qrcode generates raw SVG XML. 
                // We'll generate a raw SVG string, which DomPDF renders beautifully.
                $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)->generate($qrUrl);
                $isiSurat = str_replace(['{{ qr_code_placeholder }}', '{qr_code_placeholder}'], $qrCode, $isiSurat);
            } catch (\Exception $e) {
                $isiSurat = str_replace(['{{ qr_code_placeholder }}', '{qr_code_placeholder}'], '[QR Code Error]', $isiSurat);
            }
            
            $fotoPlaceholder = '<table style="width: 100px; height: 133px; border: 1px solid #000000; border-collapse: collapse; margin: 0 auto; background: #ffffff;"><tr><td style="text-align: center; vertical-align: middle; font-size: 8pt; font-family: Arial, sans-serif; color: #000000;">[Pas Foto 3x4]</td></tr></table>';
            $isiSurat = str_replace(['{{ foto_pemohon_placeholder }}', '{foto_pemohon_placeholder}'], $fotoPlaceholder, $isiSurat);
        @endphp
        {!! $isiSurat !!}
    </div>

</body>
</html>
