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

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $kelas = Kelas::where('nama_kelas','LIKE','%'.$request->search.'%')->get();
        }
        else {
            $kelas = Kelas::all();
        }
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
        $tingkat = $request->input('tingkat');
        $jurusan = $request->input('jurusan');
        $rombel = $request->input('rombel');

        $result = $tingkat . ' ' . $jurusan . ' ' . $rombel;

        Kelas::create([
            'nama_kelas' => $result,
        ]);

        // Redirect or respond as needed
        return redirect()->route('dashboard-management-kelas');
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
        return view('pages.management.dashboard-edit-kelas', $data);
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
        ]);

        return redirect()->route('dashboard-management-kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kelas::destroy($id);
        return redirect()->route('dashboard-management-kelas');
    }
}
