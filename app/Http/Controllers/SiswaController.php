<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('pages.management.siswa.index', [
            'kelas' => $kelas,
        ]);
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $kelas = Siswa::where('nama_kelas', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $kelas = Siswa::all();
        }
        return view('pages.management.dashboard-siswa', [
            'kelas' => $kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $kelas = Kelas::all(); // Mengambil semua data kelas
        $data = [
            'kelas' => $kelas,
            'id_kelas' => $id,
        ];
        return view('pages.management.siswa.add', $data); // Kirim data kelas ke view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required',
        ]);

        $siswa = new Siswa;
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->id_kelas = $id;

        $siswa->save();

        return redirect()->route('management-siswa')->with('success', 'Data siswa berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Siswa::all()->where('id_kelas', '==', $id);
        $id_kelas = $id;
        $nama_kelas = Kelas::where('id', '=', $id)->first();
        $data = [
            'nama_kelas' => $nama_kelas,
            'siswa' => $kelas,
            'id_kelas' => $id_kelas,
            'poin' => $kelas
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
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            $siswa = Siswa::where('NIS', $NIS)->first();

            if (!$siswa) {
                return redirect()->route('management-siswa')->with('error', 'Siswa tidak ditemukan.');
            }

            $siswa->absen()->delete();
            $siswa->delete();

            return redirect()->route('management-siswa')->with('success');
        } finally {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }

    

    // Function Export
    public function exportSiswaByKelas($id_kelas)
    {
        $export = new SiswaExport($id_kelas);
        return Excel::download($export, 'siswa-excel.xlsx');
    }


    //Function Import
    public function import_excel(Request $request, $id_kelas) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_siswa',$nama_file);
 
		// import data
		Excel::import(new SiswaImport($id_kelas), public_path('/file_siswa/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect()->route('data-siswa', $id_kelas);

	}
}
