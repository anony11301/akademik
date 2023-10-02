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
        return view('pages.management.dashboard-tambah-siswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
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
    public function edit(string $id)
    {
        $item = Siswa::findOrFail($id);
        $data = [
            'kelas' => $item,
        ];
        return view('pages.management.dashboard-edit-siswa', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Siswa::destroy($id);
        return redirect()->route('management-siswa');
    }

    // Function Export
    public function exportExcel()
    {
        return Excel::download(new KelasExport,'kelas-excel.xlsx');
    }
}
