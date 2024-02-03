<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsenExport;

class AbsenController extends Controller
{
    // Menampilkan daftar kelas
    public function index()
    {
        $kelas = Kelas::all();
        $jumlahAbsen = [];
        $jumlahTidakHadir = [];

        foreach ($kelas as $item) {
            $tanggalSekarang = now()->toDateString();

            $count = Absensi::where('tanggal', $tanggalSekarang)
                ->where('id_kelas', $item->id)
                ->whereNotIn('status', ['hadir'])
                ->count();

            $jumlahTidakHadir[$item->id] = $count;
        }

        foreach ($kelas as $item) {
            $tanggalSekarang = now()->toDateString();

            $count = Absensi::where('tanggal', $tanggalSekarang)
                ->where('id_kelas', $item->id)
                ->count();

            $jumlahAbsen[$item->id] = $count;
        }
        return view('pages.guru.absen.index', [
            'kelas' => $kelas,
            'jumlahTidakHadir' => $jumlahTidakHadir,
            'jumlahAbsen' => $jumlahAbsen
        ]);
    }



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
        $nisn = $request->input('nisn');
        $kelas_id = $request->input('kelas_id');


        foreach ($nisn as $key => $n) {
            $absen = new Absensi();
            $absen->tanggal = $tanggal;
            $absen->status = $status[$key];
            $absen->keterangan = $keterangan[$key];
            $absen->NISN = $n;
            $absen->id_kelas = $kelas_id;
            $absen->save();
        }


        return redirect()->route('absen.index');
    }





    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);

        return view('pages.guru.absen.edit', compact('absensi'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'tanggal' => 'required',
            'status' => 'required',
        ]);


        $absensi = Absensi::findOrFail($id);
        $absensi->update($request->all());

        return redirect()->route('absen.create', $absensi->id_kelas)
            ->with('success', 'Absensi berhasil diupdate.');
    }


    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $id_kelas = $absensi->id_kelas;
        $absensi->delete();

        return redirect()->route('absen.create', $id_kelas)
            ->with('success', 'Absensi berhasil dihapus.');
    }

    public function select()
    {
        $kelas = Kelas::all();
        return view('pages.guru.absen.select', [
            'kelas' => $kelas,
        ]);
    }


    public function show($kelas_id, Request $request)
    {
        $absend = Absensi::whereDate('tanggal', today())->get();
        $siswa = Siswa::where('id_kelas', $kelas_id)->orderBy('nama')->get();
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
            ->orderBy('tanggal', 'desc') // Order by the 'tanggal' field for sorting by date.
            ->get();

        // Debugging statements
        // dd($request->date_from, $request->date_to); // Check date parameters.
        // dd($absen->toSql()); // Check the generated SQL query.
        // dd($absen->toArray()); // Check the retrieved data.

        return view('pages.management.absen.detail', compact('absen', 'siswa', 'kelas_id', 'request', 'absend'));
    }


    // public function exportExcel()
    // {
    //     return Excel::download(new AbsenExport,'absen-excel.xlsx');
    // }

}
