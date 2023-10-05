<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('pages.guru.dashboard',[
            'kelas' => $kelas,
        ]);
    }

    public function select()
    {
        $kelas = Kelas::all();
        return view('pages.guru.absen.select',[
            'kelas' => $kelas,
        ]);
    }

    //Create Absen
    public function create($kelas_id)
    {
        $siswa = Siswa::where('id_kelas', $kelas_id)->get();
        return view('pages.guru.absen.add', compact('siswa', 'kelas_id'));
    }

    public function store(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $status = $request->input('status');
        $keterangan = $request->input('keterangan');
        $nis = $request->input('nis');
        $kelas_id = $request->input('kelas_id');


        foreach ($nis as $key => $n) {
            $absen = new Absensi();
            $absen->tanggal = $tanggal;
            $absen->status = $status[$key];
            $absen->ketergantungan = $ketergantungan[$key];
            $absen->NIS = $n;
            $absen->id_kelas = $kelas_id;
            $absen->save();
        }


        return redirect()->route('absen.index');
    }
}
