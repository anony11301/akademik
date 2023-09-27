<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('pages.management.dashboard-kelas',[
            'kelas' => $kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.management.dashboard-tambah-kelas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            
            $tingkat = $request->input('tingkat');
            $jurusan = $request->input('jurusan');
            $rombel = $request->input('rombel');
    
            
            $result = $tingkat . ' ' . $jurusan . ' ' . $rombel;
    
            Kelas::create([
                'nama_kelas' => $result,
            ]);
    
            // Redirect atau berikan respons sesuai kebutuhan Anda
            return redirect("pages.management.dashboard-kelas");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        //
    }
}
