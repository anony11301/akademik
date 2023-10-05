<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

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
        return view('pages.guru.absen.index',[
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
            $absen->keterangan = $keterangan[$key];
            $absen->NIS = $n;
            $absen->id_kelas = $kelas_id;
            $absen->save();
        }


        return redirect()->route('absen.index');
    }

    public function show($kelas_id, Request $request)
    {
        $absend = Absensi::all();
        $siswa = Siswa::where('id_kelas', $kelas_id)->get();
        $absen = Absensi::where('id_kelas', $kelas_id)
            ->when(
                $request->date_from && $request->date_to,
                function (Builder $builder) use ($request) {
                    $builder->whereBetween(
                        DB::raw('tanggal'),
                        [
                            $request->date_from,
                            $request->date_to
                        ]
                    );
                }
            )
            ->orderBy('tanggal', 'desc')
            ->get();

        
        return view('pages.guru.absen.detail', compact('absen', 'siswa', 'kelas_id', 'request', 'absend'));
    }
}
