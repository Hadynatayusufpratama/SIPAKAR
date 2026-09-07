<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Permohonan SIPAKAR / SIMAKSI</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; margin: 10px; }
        h2, h4 { text-align: center; margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 5px; text-align: left; vertical-align: middle; }
        th { background-color: #1b4d3e; color: white; text-align: center; font-size: 9px; }
        td { font-size: 9px; }
        .text-center { text-align: center; }
        a { color: #0066cc; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <h2>BALAI KONSERVASI SUMBER DAYA ALAM (BKSDA) SULAWESI TENGAH</h2>
    <h4>LAPORAN PERMOHONAN SIPAKAR / SIMAKSI</h4>
    <h4 style="font-weight: normal; font-size: 11px;">Kategori: {{ strtoupper($kategori) }} | Periode: {{ $periodeMulai }} s/d {{ $periodeSelesai }}</h4>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>TGL DAFTAR</th>
                <th>NAMA LENGKAP</th>
                <th>KATEGORI</th>
                @if($kategori !== 'umum')
                    <th>NIM</th>
                    <th>PRODI / FAKULTAS</th>
                @endif
                <th>INSTANSI</th>
                <th>KONTAK</th>
                <th>JUDUL PENELITIAN</th>
                <th>LOKASI</th>
                <th>STATUS</th>
                <th>KTP</th>
                <th>SURAT PENGANTAR</th>
                <th>PROPOSAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}</td>
                <td>{{ $item->nama_lengkap ?? '-' }}</td>
                <td>{{ strtoupper($item->kategori_pemohon ?? '-') }}</td>
                
                @if($kategori !== 'umum')
                    <td>{{ $item->nim ?? '-' }}</td>
                    <td>{{ $item->prodi ?? '-' }} / {{ $item->fakultas ?? '-' }}</td>
                @endif

                <td>{{ $item->asal_instansi ?? '-' }}</td>
                <td>{{ $item->no_hp ?? '-' }}</td>
                <td>{{ $item->judul_penelitian ?? '-' }}</td>
                <td>{{ $item->lokasi_penelitian ?? '-' }}</td>
                <td class="text-center"><b>{{ strtoupper($item->status ?? '-') }}</b></td>
                
                <td class="text-center">
                    @if($item->file_ktp)
                        <a href="{{ asset('storage/' . $item->file_ktp) }}" target="_blank">Unduh KTP</a>
                    @else
                        -
                    @endif
                </td>
                <td class="text-center">
                    @if($item->file_surat_pengantar)
                        <a href="{{ asset('storage/' . $item->file_surat_pengantar) }}" target="_blank">Unduh Surat</a>
                    @else
                        -
                    @endif
                </td>
                <td class="text-center">
                    @if($item->file_proposal)
                        <a href="{{ asset('storage/' . $item->file_proposal) }}" target="_blank">Unduh Proposal</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>