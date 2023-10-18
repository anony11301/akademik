<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\DataPelanggaran;
use Illuminate\Support\Carbon;

class ManagementController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();

        $now = Carbon::now();

        $bulanSekarang = $now->month;
        $tahunSekarang = $now->year;

        $absensi = Absensi::whereYear('tanggal', $tahunSekarang)
            ->whereMonth('tanggal', $bulanSekarang)
            ->get();

        $totalKehadiran = $absensi->where('status', 'hadir')->count();
        $totalSiswa = $absensi->count();

        $persentaseKehadiran = ($totalKehadiran / $totalSiswa) * 100;

        $pelanggaran = DataPelanggaran::whereYear('tanggal', $tahunSekarang)
            ->whereMonth('tanggal', $bulanSekarang)
            ->get();

        $totalPelanggaran = $pelanggaran->count();

        return view(
            'pages.management.dashboard',
            [
                'jumlahSiswa' => $jumlahSiswa,
                'jumlahKelas' => $jumlahKelas,
                'persentaseKehadiran' => $persentaseKehadiran,
                'totalPelanggaran' => $totalPelanggaran,
            ]
        );
    }
}
