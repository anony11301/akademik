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
        
        return view('pages.management.data pelanggaran.index', [
            'kelas' => $data,
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
