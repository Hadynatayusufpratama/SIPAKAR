<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Izin SIMAKSI</title>
    <style>
        body { 
            font-family: sans-serif; 
            font-size: 13px; 
            line-height: 1.6; 
            color: #333;
        }
        .header { 
            text-align: center; 
            border-bottom: 3px double #000; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
        }
        .header h4 { 
            margin: 2px 0; 
            font-size: 14px;
            text-transform: uppercase;
        }
        .header p { 
            font-size: 11px; 
            margin: 2px 0; 
        }
        .title-section { 
            text-align: center; 
            margin-bottom: 20px; 
        }
        .title-section h3 { 
            text-decoration: underline; 
            margin-bottom: 5px; 
            font-size: 15px;
        }
        .title-section p { 
            margin: 0; 
            font-size: 12px; 
        }
        .content { 
            margin: 20px 0; 
        }
        .table-data { 
            width: 100%; 
            margin-top: 10px; 
            border-collapse: collapse;
        }
        .table-data td { 
            padding: 6px 4px; 
            vertical-align: top; 
        }
        .footer { 
            margin-top: 40px; 
            float: right; 
            text-align: center; 
            width: 250px;
        }
        .footer p {
            margin: 3px 0;
        }
        .signature-space {
            height: 60px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h4>KEMENTERIAN LINGKUNGAN HIDUP DAN KEHUTANAN</h4>
        <h4>BALAI KONSERVASI SUMBER DAYA ALAM SULAWESI TENGAH</h4>
        <p>Jl. Prof. Dr. Moh. Yamin No. 5 Kota Palu, Sulawesi Tengah</p>
    </div>

    <div class="title-section">
        <h3>SURAT IZIN MASUK KAWASAN KONSERVASI (SIMAKSI)</h3>
        <p>Nomor: 005 / SIMAKSI / BKSDA-SULTENG / {{ date('Y') }}</p>
    </div>

    <div class="content">
        <p>Diberikan izin kepada pemohon di bawah ini:</p>
        
        <table class="table-data">
            <tr>
                <td style="width: 140px;">Nama Lengkap</td>
                <td style="width: 10px;">:</td>
                <td><strong>{{ $permohonan->name ?? ($permohonan->nama_lengkap ?? '-') }}</strong></td>
            </tr>
            <tr>
                <td>NIK / NIP</td>
                <td>:</td>
                <td>{{ $permohonan->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Keperluan / Kegiatan</td>
                <td>:</td>
                <td>{{ $permohonan->keperluan ?? 'Penelitian / Kegiatan Konservasi' }}</td>
            </tr>
            <tr>
                <td>Lokasi Kawasan</td>
                <td>:</td>
                <td>{{ $permohonan->lokasi ?? 'Kawasan Konservasi BKSDA Sulawesi Tengah' }}</td>
            </tr>
            <tr>
                <td>Status Izin</td>
                <td>:</td>
                <td><strong style="color: green;">DISETUJUI</strong></td>
            </tr>
        </table>

        <p style="margin-top: 20px;">
            Pemohon diwajibkan mematuhi segala ketentuan dan peraturan perundang-undangan yang berlaku mengenai konservasi sumber daya alam hayati dan ekosistemnya serta melapor kepada petugas setempat sebelum melaksanakan kegiatan.
        </p>
    </div>

    <div class="footer">
        <p>Palu, {{ date('d F Y') }}</p>
        <p><strong>Kepala Balai KSDA Sulawesi Tengah</strong></p>
        <div class="signature-space"></div>
        <p><strong>( ___________________________ )</strong></p>
    </div>
</body>
</html>