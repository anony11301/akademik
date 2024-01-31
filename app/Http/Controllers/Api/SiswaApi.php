<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SiswaApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Siswa::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $siswa = new Siswa;
        $siswa->NISN = $request->NISN;
        $siswa->nama = $request->nama;
        $siswa->id_kelas = $request->id_kelas;

        $siswa->save();

        return response()->json([
            'status' => true,
            'message' => "Data Created successfully!",
            'siswa' => $siswa->latest()->first()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Siswa::where('id_kelas', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::find($id);
        $siswa->NISN = $request->NISN;
        $siswa->nama = $request->nama;
        $siswa->id_kelas = $request->id_kelas;

        $siswa->update();

        return response()->json([
            'status' => true,
            'message' => "Data Updated successfully!",
            'siswa' => $siswa
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);

        $siswa->delete();

        return response()->json([
            'status' => true,
            'message' => "Data Deleted successfully!",
        ]);
    }
}
