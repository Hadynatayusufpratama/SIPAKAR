<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Preview Rekapitulasi Lengkap SIMAKSI - BKSDA SULTENG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-full mx-auto bg-white p-6 rounded-lg shadow-md overflow-hidden">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 border-b pb-4">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Preview Data Keseluruhan & Berkas SIMAKSI</h1>
                <p class="text-sm text-gray-500">Kategori: <span class="font-semibold uppercase">{{ $kategori }}</span> | Periode: <span class="font-semibold">{{ $periodeMulai }} s/d {{ $periodeSelesai }}</span></p>
            </div>
            
            <!-- Tombol unduh file -->
            <div class="flex gap-2">
                <a href="{{ route('admin.export.data', ['kategori' => $kategori, 'periode_mulai' => $periodeMulai, 'periode_selesai' => $periodeSelesai, 'format' => 'excel']) }}" class="bg-emerald-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-emerald-700 transition">
                    <i class="fa-solid fa-file-excel mr-1"></i> Download Excel
                </a>
                <a href="{{ route('admin.export.data', ['kategori' => $kategori, 'periode_mulai' => $periodeMulai, 'periode_selesai' => $periodeSelesai, 'format' => 'pdf']) }}" class="bg-rose-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-rose-700 transition">
                    <i class="fa-solid fa-file-pdf mr-1"></i> Download PDF
                </a>
            </div>
        </div>

        <!-- Tabel Data Lengkap Sesuai Kolom Database -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-xs text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="border border-gray-300 p-2 text-center w-10">No</th>
                        <th class="border border-gray-300 p-2">Identitas Utama</th>
                        <th class="border border-gray-300 p-2">Akademik / Instansi</th>
                        <th class="border border-gray-300 p-2">Kontak & Alamat</th>
                        <th class="border border-gray-300 p-2">Detail Kegiatan & Lokasi</th>
                        <th class="border border-gray-300 p-2 text-center">Status & Zoom</th>
                        <th class="border border-gray-300 p-2">Berkas Persyaratan (Upload)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                    <tr class="hover:bg-gray-50 align-top">
                        <td class="border border-gray-300 p-2 text-center font-semibold">{{ $index + 1 }}</td>
                        
                        <!-- Identitas -->
                        <td class="border border-gray-300 p-2">
                            <span class="font-bold text-gray-900 block">{{ $item->nama_lengkap ?? '-' }}</span>
                            <span class="inline-block mt-1 px-2 py-0.5 bg-blue-50 text-blue-700 rounded text-[10px] font-semibold uppercase">
                                {{ $item->kategori_pemohon ?? '-' }}
                            </span>
                            <span class="block text-[11px] text-gray-600 mt-1">NIK/NIP: {{ $item->nik_nip ?? '-' }}</span>
                            <span class="block text-[11px] text-gray-500">TTL: {{ $item->tempat_lahir ?? '-' }}, {{ $item->tanggal_lahir ? date('d-m-Y', strtotime($item->tanggal_lahir)) : '-' }}</span>
                        </td>

                        <!-- Akademik / Instansi -->
                        <td class="border border-gray-300 p-2">
                            <span class="block font-medium text-gray-800">Instansi: {{ $item->asal_instansi ?? '-' }}</span>
                            @if(strtolower($item->kategori_pemohon) == 'mahasiswa')
                                <div class="mt-1 pt-1 border-t border-gray-200 text-[11px] text-gray-600 space-y-0.5">
                                    <span class="block"><strong>NIM:</strong> {{ $item->nim ?? '-' }}</span>
                                    <span class="block"><strong>Prodi:</strong> {{ $item->prodi ?? '-' }}</span>
                                    <span class="block"><strong>Fakultas:</strong> {{ $item->fakultas ?? '-' }}</span>
                                </div>
                            @endif
                        </td>

                        <!-- Kontak & Alamat -->
                        <td class="border border-gray-300 p-2">
                            <span class="block"><strong>HP:</strong> {{ $item->no_hp ?? '-' }}</span>
                            <span class="block mt-1 text-gray-600"><strong>Alamat:</strong> {{ $item->alamat ?? '-' }}</span>
                        </td>

                        <!-- Kegiatan & Lokasi -->
                        <td class="border border-gray-300 p-2">
                            <span class="font-semibold text-gray-900 block">{{ $item->judul_penelitian ?? '-' }}</span>
                            <span class="block mt-1 text-gray-600"><strong>Tujuan:</strong> {{ $item->tujuan_kegiatan ?? '-' }}</span>
                            <span class="block mt-1 text-indigo-700 font-medium"><strong>Lokasi:</strong> {{ $item->lokasi_penelitian ?? '-' }}</span>
                            <span class="block mt-1 text-gray-500 text-[11px]">Durasi: {{ $item->tanggal_mulai ? date('d/m/Y', strtotime($item->tanggal_mulai)) : '-' }} s/d {{ $item->tanggal_selesai ? date('d/m/Y', strtotime($item->tanggal_selesai)) : '-' }}</span>
                        </td>

                        <!-- Status & Zoom -->
                        <td class="border border-gray-300 p-2 text-center">
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold uppercase inline-block mb-1
                                @if(strtolower($item->status) == 'disetujui' || strtolower($item->status) == 'sukses') bg-green-100 text-green-800 
                                @elseif(strtolower($item->status) == 'ditolak') bg-red-100 text-red-800 
                                @else bg-amber-100 text-amber-800 @endif">
                                {{ $item->status ?? 'Pending' }}
                            </span>
                            @if(!empty($item->tanggal_zoom))
                                <span class="block text-[10px] text-gray-600 mt-1">Jadwal: {{ \Carbon\Carbon::parse($item->tanggal_zoom)->format('d/m/Y H:i') }}</span>
                            @endif
                            @if(!empty($item->link_zoom))
                                <a href="{{ $item->link_zoom }}" target="_blank" class="text-blue-600 underline text-[10px] block mt-0.5">Buka Link Zoom</a>
                            @endif
                        </td>

                        <!-- Berkas Persyaratan Upload -->
                        <td class="border border-gray-300 p-2">
                            <div class="space-y-1 text-[11px]">
                                @if(!empty($item->file_ktp))
                                    <a href="{{ asset('storage/' . $item->file_ktp) }}" target="_blank" class="text-indigo-600 hover:underline block truncate max-w-[150px]">
                                        <i class="fa-solid fa-file-arrow-down mr-1"></i> KTP: {{ basename($item->file_ktp) }}
                                    </a>
                                @endif
                                @if(!empty($item->file_surat_pengantar))
                                    <a href="{{ asset('storage/' . $item->file_surat_pengantar) }}" target="_blank" class="text-indigo-600 hover:underline block truncate max-w-[150px]">
                                        <i class="fa-solid fa-file-arrow-down mr-1"></i> Surat Pengantar
                                    </a>
                                @endif
                                @if(!empty($item->file_proposal))
                                    <a href="{{ asset('storage/' . $item->file_proposal) }}" target="_blank" class="text-indigo-600 hover:underline block truncate max-w-[150px]">
                                        <i class="fa-solid fa-file-arrow-down mr-1"></i> Proposal
                                    </a>
                                @endif
                                @if(empty($item->file_ktp) && empty($item->file_surat_pengantar) && empty($item->file_proposal))
                                    <span class="text-gray-400 italicf">Tidak ada berkas terlampir</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="border border-gray-300 p-6 text-center text-gray-500">
                            Tidak ada data permohonan yang ditemukan untuk periode atau kategori ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>