<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggaran;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DataPelanggaranController extends Controller
{
    public function index()
    {
        $data = Kelas::all();
        $jumlahPelanggaran = [];

        foreach ($data as $item) {
            $tanggalSekarang = now()->toDateString();
            
            $count = DataPelanggaran::where('tanggal', $tanggalSekarang)
                ->where('id_kelas', $item->id)
                ->count();

            $jumlahPelanggaran[$item->id] = $count;
        }
        
        return view('pages.management.data pelanggaran.index', [
            'kelas' => $data,
            'jumlahPelanggaran' => $jumlahPelanggaran,
        ]);
    }

    public function show(string $id)
    {
        $data = Siswa::where('id_kelas', $id)->get();
        $kelas = Kelas::where('id', $id)->first();
        $pelanggaran = Pelanggaran::all();
        return view('pages.management.data pelanggaran.add',[
            'siswa' => $data,
            'kelas' => $kelas,
            'pelanggaran' => $pelanggaran,
            'kelas_id' => $id
        ]);
    }

    public function store(Request $request, string $id)
    {
        $nis = $request->nis;
        $id_pelanggaran = $request->id_pelanggaran;
        $kelas_id = $id;
        $date = Carbon::today();

        DataPelanggaran::create([
            'NIS' => $nis,
            'id_pelanggaran' => $id_pelanggaran,
            'id_kelas' => $kelas_id,
            'tanggal' => $date,
        ]);

        return redirect()->route('data-pelanggaran-kelas', $id);
    }

    public function detail($kelas_id, Request $request)
    {
        $
        $siswa = Siswa::where('id_kelas', $kelas_id)->get();
        $query = Absensi::where('id_kelas', $kelas_id);
    
        // Filter berdasarkan tanggal hari ini jika tidak ada rentang tanggal yang diberikan
        if (!$request->date_from && !$request->date_to) {
            $query->whereDate('tanggal', today());
        }
    
        // Filter berdasarkan rentang tanggal jika ada date_from dan date_to
        if ($request->date_from && $request->date_to) {
            $query->whereBetween('tanggal', [$request->date_from, $request->date_to]);
        }
    
        $absen = $query->orderBy('tanggal', 'desc')->get();

        $kehadiran = $absen->where('status','hadir')->count();
        $total_siswa = $absen->count();
        if ($kehadiran == 0){
            $persentasi_kehadiran = 0;
        } else {
        $persentasi_kehadiran = $kehadiran / $total_siswa * 100;
        }

        // $data = compact('absen', 'siswa', 'kelas_id', 'request', 'absend');
        $data = [
            'absen' => $absen,
            'siswa' => $siswa,
            'kelas_id' => $kelas_id,
            'request' => $request,
            'persentasi_kehadiran' => $persentasi_kehadiran,
        ];
        Session::put('data_pelanggaran', $data_pelanggaran);
        return view('pages.management.data pelanggaran.detail', $data);
        // return Excel::download(new AbsenExport($absen), 'export-absen.xlsx');
        // return dd($absen)->get();
    }
}
