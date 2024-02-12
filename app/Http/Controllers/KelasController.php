<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KelasExport;
use App\Models\Absensi;
use App\Models\DataPelanggaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('pages.management.kelas.index', [
            'kelas' => $kelas,
        ]);
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $kelas = Kelas::where('nama_kelas', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $kelas = Kelas::all();
        }
        return view('pages.management.kelas.index', [
            'kelas' => $kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.management.kelas.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tingkat = $request->input('tingkat');
        $jurusan = $request->input('jurusan');
        $rombel = $request->input('rombel');

        $result = $tingkat . ' ' . $jurusan . ' ' . $rombel;

        Kelas::create([
            'nama_kelas' => $result,
            'created_by' => Auth::user()->id,
        ]);

        // Redirect or respond as needed
        return redirect()->route('management-kelas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Kelas::findOrFail($id);
        $data = [
            'kelas' => $item,
        ];
        return view('pages.management.kelas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Kelas::findOrFail($id);
        $tingkat = $request->input('tingkat');
        $jurusan = $request->input('jurusan');
        $rombel = $request->input('rombel');

        $result = $tingkat . ' ' . $jurusan . ' ' . $rombel;

        $item->update([
            'nama_kelas' => $result,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('management-kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::where('id_kelas', $id)->get();
        $absen =  Absensi::where('id_kelas', $id)->get();
        $pelanggaran = DataPelanggaran::where('id_kelas', $id)->get();

        if ($pelanggaran) {

            foreach ($pelanggaran as $item) {
                $item->delete();
            }
        }
        if ($absen) {
            foreach ($absen as $item) {
                $item->delete();
            }
        }
        if ($siswa) {

            foreach ($siswa as $item) {
                $item->delete();
            }
        }
        Kelas::destroy($id);
        return redirect()->route('management-kelas')->with(['berhasil' => true]);
    }

    // Function Export
    public function exportExcel()
    {
        return Excel::download(new KelasExport, 'kelas-excel.xlsx');
    }
}
