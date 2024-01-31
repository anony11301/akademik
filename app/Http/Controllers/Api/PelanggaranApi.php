<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pelanggaran::all();
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
        $pelanggaran = new Pelanggaran;
        $pelanggaran->nama_pelanggaran = $request->nama_pelanggaran;
        $pelanggaran->poin = $request->poin;

        $pelanggaran->save();

        return response()->json([
            'status' => true,
            'message' => "Data Created successfully!",
            'pelanggaran' => $pelanggaran->latest()->first()
        ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggaran = Pelanggaran::find($id);
        $pelanggaran->nama_pelanggaran = $request->nama_pelanggaran;
        $pelanggaran->poin = $request->poin;

        $pelanggaran->update();

        return response()->json([
            'status' => true,
            'message' => "Data Updated successfully!",
            'pelanggaran' => $pelanggaran
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggaran = Pelanggaran::find($id);

        $pelanggaran->delete();

        return response()->json([
            'status' => true,
            'message' => "Data Deleted successfully!",
        ]);
    }
}
