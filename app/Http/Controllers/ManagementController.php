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

        if($totalKehadiran == 0){
            $persentaseKehadiran = 0;
        }
        else {
            $persentaseKehadiran = ($totalKehadiran / $totalSiswa) * 100;
        }

        $pelanggaran = DataPelanggaran::whereYear('tanggal', $tahunSekarang)
            ->whereMonth('tanggal', $bulanSekarang)
            ->get();

        $totalPelanggaran = $pelanggaran->count();

        //chart pelanggaran
        // Ambil data pelanggaran dari database
        $dataPelanggaran = DataPelanggaran::all();

        // Buat array asosiatif untuk label bulan dan setel nilai awalnya ke 0
        $labels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des',
        ];

        $data = array_fill(0, 12, 0);

        $tahun = Carbon::now()->year;

        for($i = 1; $i <= 12; $i++ )
        {
            $data[$i - 1] = DataPelanggaran::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->count();
        }

        return view(
            'pages.management.dashboard',
            [
                'jumlahSiswa' => $jumlahSiswa,
                'jumlahKelas' => $jumlahKelas,
                'persentaseKehadiran' => $persentaseKehadiran,
                'totalPelanggaran' => $totalPelanggaran,
                'labels' => $labels,
                'data' => $data
            ]
        );

        // return dd($data, $labels)->get();
    }
}
