<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Permohonan SIPAKAR / SIMAKSI</title>
</head>
<body>
    <table>
        <tr>
            <td colspan="{{ $kategori !== 'umum' ? '14' : '12' }}" style="text-align: center; font-weight: bold; font-size: 14px;">
                BALAI KONSERVASI SUMBER DAYA ALAM (BKSDA) SULAWESI TENGAH
            </td>
        </tr>
        <tr>
            <td colspan="{{ $kategori !== 'umum' ? '14' : '12' }}" style="text-align: center; font-weight: bold;">
                LAPORAN PERMOHONAN SIPAKAR / SIMAKSI
            </td>
        </tr>
        <tr>
            <td colspan="{{ $kategori !== 'umum' ? '14' : '12' }}" style="text-align: center;">
                Kategori: {{ strtoupper($kategori) }} | Periode: {{ $periodeMulai }} s/d {{ $periodeSelesai }}
            </td>
        </tr>
        <tr><td colspan="{{ $kategori !== 'umum' ? '14' : '12' }}"></td></tr>
    </table>

    <table border="1">
        <thead>
            <tr style="background-color: #1b4d3e; color: white; font-weight: bold; text-align: center;">
                <th>NO</th>
                <th>TGL DAFTAR</th>
                <th>NAMA LENGKAP</th>
                <th>KATEGORI</th>
                @if($kategori !== 'umum')
                    <th>NIM</th>
                    <th>PRODI</th>
                    <th>FAKULTAS</th>
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
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}</td>
                <td>{{ $item->nama_lengkap ?? '-' }}</td>
                <td>{{ strtoupper($item->kategori_pemohon ?? '-') }}</td>
                
                @if($kategori !== 'umum')
                    <td>{{ $item->nim ?? '-' }}</td>
                    <td>{{ $item->prodi ?? '-' }}</td>
                    <td>{{ $item->fakultas ?? '-' }}</td>
                @endif

                <td>{{ $item->asal_instansi ?? '-' }}</td>
                <td>{{ $item->no_hp ?? '-' }}</td>
                <td>{{ $item->judul_penelitian ?? '-' }}</td>
                <td>{{ $item->lokasi_penelitian ?? '-' }}</td>
                <td style="text-align: center;">{{ strtoupper($item->status ?? '-') }}</td>
                
                <td>{{ $item->file_ktp ? asset('storage/' . $item->file_ktp) : '-' }}</td>
                <td>{{ $item->file_surat_pengantar ? asset('storage/' . $item->file_surat_pengantar) : '-' }}</td>
                <td>{{ $item->file_proposal ? asset('storage/' . $item->file_proposal) : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>