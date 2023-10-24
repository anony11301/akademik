<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\DataPelanggaran;
use Illuminate\Support\Carbon;

class GuestController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $jumlahTidakHadir = [];

        foreach ($kelas as $item) {
            $tanggalSekarang = now()->toDateString();
            
            $count = Absensi::where('tanggal', $tanggalSekarang)
                ->where('id_kelas', $item->id)
                ->whereNotIn('status', ['hadir']) 
                ->count();

            $jumlahTidakHadir[$item->id] = $count;
        }

        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();

        $now = carbon::now();

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


        return view('pages.guest.index',[
            'kelas' => $kelas,
            'jumlahTidakHadir' => $jumlahTidakHadir,
            'persentaseKehadiran' => $persentaseKehadiran,
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function show($kelas_id, Request $request)
    {
        $siswa = Siswa::where('id_kelas', $kelas_id)->get();
    
        $statusFilter = $request->input('status_filter');
    
        $query = Absensi::where('id_kelas', $kelas_id);
    
        // Filter berdasarkan tanggal hari ini jika tidak ada rentang tanggal yang diberikan
        if (!$request->date_from && !$request->date_to) {
            $query->whereDate('tanggal', today());
        }
    
        // Filter berdasarkan rentang tanggal jika ada date_from dan date_to
        if ($request->date_from && $request->date_to) {
            $query->whereBetween('tanggal', [$request->date_from, $request->date_to]);
        }
    
        if ($statusFilter === 'tidak-hadir') {
            $query->where('status', '!=', 'hadir');
        } elseif (!empty($statusFilter)) {
            $query->where('status', $statusFilter);
        }
    
        $absen = $query->orderBy('tanggal', 'desc')->get();

        $kehadiran = $absen->where('status','hadir')->count();
        $total_siswa = $absen->count();
        if ($kehadiran == 0){
            $persentasi_kehadiran = 0;
        } else {
        $persentasi_kehadiran = $kehadiran / $total_siswa * 100;
        }

        $kelas = Kelas::where('id', $kelas_id)->get();
        // $data = compact('absen', 'siswa', 'kelas_id', 'request', 'absend');
        $data = [
            'absen' => $absen,
            'siswa' => $siswa,
            'kelas_id' => $kelas_id,
            'request' => $request,
            'persentasi_kehadiran' => $persentasi_kehadiran,
            'kelas' => $kelas,
        ];
        return view('pages.guest.detail', $data);
        // return dd($data)->get();
    }
}
