<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KelasExport;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('pages.management.siswa.index',[
            'kelas' => $kelas,
        ]);
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $kelas = Siswa::where('nama_kelas','LIKE','%'.$request->search.'%')->get();
        }
        else {
            $kelas = Siswa::all();
        }
        return view('pages.management.dashboard-siswa',[
            'kelas' => $kelas,
        ]);     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all(); // Mengambil semua data kelas
        return view('pages.management.siswa.add', compact('kelas')); // Kirim data kelas ke view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required',
            'id_kelas' => 'required',
        ]);

        $siswa = new Siswa;
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->id_kelas = $request->id_kelas;

        $siswa->save();

        return redirect()->route('management-siswa')->with('success', 'Data siswa berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Siswa::all()->where('id_kelas', '==', $id);
        $data = [
            'siswa' => $kelas,
        ];

        return view('pages.management.siswa.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($NIS)
    {
        $siswa = Siswa::where('NIS', $NIS)->first();

        if (!$siswa) {
            return redirect()->route('management-siswa')->with('error', 'Siswa tidak ditemukan.');
        }

        $kelas = Kelas::all();

        return view('pages.management.siswa.edit', [
            'siswa' => $siswa,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $NIS)
    {
        // Validasi data yang dikirimkan dari form edit
        $request->validate([
            'NIS' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
        ]);

        // Cari siswa berdasarkan NIS
        $siswa = Siswa::where('NIS', $NIS)->first();

        if (!$siswa) {
            return redirect()->route('management-siswa')->with('error', 'Siswa tidak ditemukan.');
        }

        // Update data siswa
        $siswa->update([
            'NIS' => $request->input('NIS'),
            'nama' => $request->input('nama'),
            'id_kelas' => $request->input('kelas'),
        ]);

        return redirect()->route('management-siswa')->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($NIS)
    {
        // Cari siswa berdasarkan NIS
        $siswa = Siswa::where('NIS', $NIS)->first();

        if (!$siswa) {
            return redirect()->route('management-siswa')->with('error', 'Siswa tidak ditemukan.');
        }

        // Hapus siswa
        $siswa->delete();

        return redirect()->route('management-siswa')->with('success', 'Siswa berhasil dihapus.');
    }

    // Function Export
    public function exportExcel()
    {
        return Excel::download(new KelasExport,'kelas-excel.xlsx');
    }
}
