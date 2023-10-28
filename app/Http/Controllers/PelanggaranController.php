<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Exports\PelanggaranExport;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use Maatwebsite\Excel\Facades\Excel;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pelanggaran::all();
        return view('pages.management.pelanggaran.index',[
            'data' => $data,
        ]);
    }

    public function select()
    {
        $kelas = Kelas::all();
        $jumlahTidakHadir = [];

        foreach ($kelas as $item) {
            $tanggalSekarang = now()->toDateString();
            
            $count = Absensi::where('tanggal', $tanggalSekarang)
                ->where('id_kelas', $item->id)
                ->whereNotIn('status', ['hadir']) 
                ->count();

            $jumlahTidakHadir[$item->id] = $count;
        }
        return view('pages.management.pelanggaran.kelas', [
            'kelas' => $kelas,
            'jumlahTidakHadir' => $jumlahTidakHadir,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.management.pelanggaran.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pelanggaran::create($request->all());

        return redirect()->route('pelanggaran');
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
        $data = Pelanggaran::findOrFail($id);
        return view('pages.management.pelanggaran.edit',[
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Pelanggaran::findOrFail($id);
        $data = $request->all();

        $item->update($data);
        return redirect()->route('pelanggaran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Pelanggaran::findOrFail($id);

        $item->delete();

        return redirect()->route('pelanggaran');
    }

    public function export()
    {
        return Excel::download(new PelanggaranExport, 'Pelanggaran.xlsx');
    }
}
