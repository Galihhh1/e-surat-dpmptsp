<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Surat - {{ $suratKeluar->nomor_surat }}</title>
    <style>
        body {
            background-color: #f1f5f9;
            margin: 0;
            padding: 40px 10px;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
        }
        .a4-page {
            background: #ffffff;
            width: 210mm;
            min-height: 297mm;
            box-sizing: border-box;
            padding: 2.5cm 2.5cm 2.5cm 2.5cm;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            position: relative;
        }
        .print-btn-bar {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(15, 23, 42, 0.9);
            padding: 10px 20px;
            border-radius: 9999px;
            display: flex;
            gap: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            z-index: 9999;
        }
        .btn-action {
            background: #2563eb;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.18s;
        }
        .btn-action:hover {
            background: #1d4ed8;
        }
        .btn-ghost {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }
        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Kop Surat Styles */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .kop-logo {
            width: 12%;
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
        .kop-text {
            width: 88%;
            text-align: center;
            vertical-align: middle;
            font-family: Arial, sans-serif;
        }
        .kop-title-1 {
            font-size: 13pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            line-height: 1.2;
        }
        .kop-title-2 {
            font-size: 14pt;
            font-weight: bold;
            margin: 2px 0 0 0;
            text-transform: uppercase;
            line-height: 1.2;
            letter-spacing: 0.5px;
        }
        .kop-sub {
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

        /* Content Styling */
        .surat-content {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000000;
        }
        
        @media print {
            body {
                background-color: #ffffff;
                padding: 0;
                display: block;
            }
            .a4-page {
                box-shadow: none;
                padding: 0;
                width: auto;
                min-height: auto;
            }
            .print-btn-bar {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="print-btn-bar">
        <a href="javascript:window.print()" class="btn-action">Cetak Surat</a>
        <a href="{{ route('surat-keluars.cetak-pdf', $suratKeluar->id) }}" class="btn-action">Unduh PDF</a>
        <a href="{{ route('surat-keluars.show', $suratKeluar->id) }}" class="btn-action btn-ghost">Kembali ke Detail</a>
    </div>

    <div class="a4-page">
        <!-- Header Kop Surat Dinas Bandar Lampung -->
        <table class="kop-table">
            <tr>
                <td class="kop-logo">
                    <div class="kop-logo-placeholder">LOGO</div>
                </td>
                <td class="kop-text">
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
        
        <!-- Double Line Divider -->
        <div class="line-double"></div>

        <!-- Letter Body Content -->
        <div class="surat-content">
            @php
                $isiSurat = $suratKeluar->isi_surat;
                try {
                    $qrUrl = url('/validasi-surat?nomor_surat=' . urlencode($suratKeluar->nomor_surat));
                    $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)->generate($qrUrl);
                    $isiSurat = str_replace(['{{ qr_code_placeholder }}', '{qr_code_placeholder}'], $qrCode, $isiSurat);
                } catch (\Exception $e) {
                    $isiSurat = str_replace(['{{ qr_code_placeholder }}', '{qr_code_placeholder}'], '[QR Code Error]', $isiSurat);
                }
                
                $fotoPlaceholder = '<div style="border: 1px solid #000; width: 100px; height: 133px; line-height: 133px; text-align: center; font-size: 8pt; background: #f8fafc; color: #64748b; margin: 0 auto;">[Pas Foto 3x4]</div>';
                $isiSurat = str_replace(['{{ foto_pemohon_placeholder }}', '{foto_pemohon_placeholder}'], $fotoPlaceholder, $isiSurat);
            @endphp
            {!! $isiSurat !!}
        </div>
    </div>

</body>
</html>
