<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggaran;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataPelanggaranController extends Controller
{
    public function index()
    {
        $data = Kelas::all();
        $jumlah_pelanggaran = [];
        $data_siswa = DataPelanggaran::with('siswa.kelas')->get();

        foreach ($data as $item) {
            
            $count = DataPelanggaran::where($item->id, $data_siswa->siswa->id_kelas)
                ->count();

            $jumlah_pelanggaran[$item->id] = $count;
        }
        return view('pages.management.data pelanggaran.index', [
            'kelas' => $data,
            'jumlah_pelanggaran' => $jumlah_pelanggaran,
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
        ]);
    }

    public function store(Request $request, string $id)
    {
        $nis = $request->nis;
        $id_pelanggaran = $request->id_pelanggaran;
        $date = Carbon::today();

        DataPelanggaran::create([
            'NIS' => $nis,
            'id_pelanggaran' => $id_pelanggaran,
            'tanggal' => $date,
        ]);

        return redirect()->route('data-pelanggaran-kelas', $id);
    }
}
