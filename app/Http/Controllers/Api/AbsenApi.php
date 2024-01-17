<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsenApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Absensi::all();
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
        $absensi = new Absensi;
        $absensi->nisn = $request->nisn;
        $absensi->tanggal = $request->tanggal;
        $absensi->status = $request->status;
        $absensi->keterangan = $request->keterangan;
        $absensi->id_kelas = $request->id_kelas;

        $absensi->save();

        

        return response()->json([
            'status' => true,
            'message' => "Data Created successfully!",
            'absensi' => $absensi->latest()->first()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Absensi::where('id_kelas', $id)->get();
    }

    public function detail(string $id)
    {
        return Absensi::where('NIS', $id)->get();
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
        $absensi = Absensi::find($id);
        $absensi->nisn = $request->nisn;
        $absensi->tanggal = $request->tanggal;
        $absensi->status = $request->status;
        $absensi->keterangan = $request->keterangan;
        $absensi->id_kelas = $request->id_kelas;

        $absensi->update();

        return response()->json([
            'status' => true,
            'message' => "Data Updated successfully!",
            'absensi' => $absensi
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $absensi = Absensi::find($id);

        $absensi->delete();

        return response()->json([
            'status' => true,
            'message' => "Data Deleted successfully!",
        ]);
    }
}
