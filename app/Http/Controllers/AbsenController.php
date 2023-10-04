<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;

class AbsenController extends Controller
{
    // Menampilkan daftar kelas
    public function index()
    {
        $kelas = Kelas::all();
        return view('pages.management.absen.index', compact('kelas'));
    }



    public function create($kelas_id)
    {
        $siswa = Siswa::where('id_kelas', $kelas_id)->get();
        return view('pages.management.absen.add', compact('siswa', 'kelas_id'));
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





    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);

        return view('pages.management.absen.edit', compact('absensi'));
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
}
