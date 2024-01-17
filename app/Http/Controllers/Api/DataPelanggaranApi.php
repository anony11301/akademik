<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataPelanggaran;
use Illuminate\Http\Request;

class DataPelanggaranApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DataPelanggaran::all();
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
        $data_pelanggaran = new DataPelanggaran;
        $data_pelanggaran->nisn = $request->nisn;
        $data_pelanggaran->is_pelanggaran = $request->is_pelanggaran;
        $data_pelanggaran->tanggal = $request->tanggal;
        $data_pelanggaran->id_kelas = $request->id_kelas;

        $data_pelanggaran->save();

        return response()->json([
            'status' => true,
            'message' => "Data Created successfully!",
            'data_pelanggaran' => $data_pelanggaran
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_pelanggaran)
    {
        return DataPelanggaran::where('id_pelanggaran', $id_pelanggaran)->get();
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
        $data_pelanggaran = DataPelanggaran::find($id);
        $data_pelanggaran->nisn = $request->nisn;
        $data_pelanggaran->is_pelanggaran = $request->is_pelanggaran;
        $data_pelanggaran->tanggal = $request->tanggal;
        $data_pelanggaran->id_kelas = $request->id_kelas;

        $data_pelanggaran->update();

        return response()->json([
            'status' => true,
            'message' => "Data Updated successfully!",
            'data_pelanggaran' => $data_pelanggaran
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_pelanggaran = DataPelanggaran::find($id);

        $data_pelanggaran->delete();

        return response()->json([
            'status' => true,
            'message' => "Data Deleted successfully!",
        ]);
    }
}
