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

    public function detail(Request $request)
    {
        $siswa = DataPelanggaran::with('siswa', 'kelas')->get();
        
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        // Cek apakah rentang tanggal sudah diatur
        if ($dateFrom && $dateTo) {
            // Jika rentang tanggal sudah diatur, gunakan filter date range
            $filteredSiswa = DataPelanggaran::whereBetween('tanggal', [$dateFrom, $dateTo])->get();
        } else {
            // Jika rentang tanggal tidak diatur, gunakan data hanya untuk hari ini
            $today = Carbon::now()->toDateString();
            $filteredSiswa = DataPelanggaran::whereDate('tanggal', $today)->get();
        }

        return view('pages.management.data pelanggaran.detail', compact('siswa', 'filteredSiswa', 'request'));
    }

}
