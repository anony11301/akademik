<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Kelas::all();
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
        $kelas = new Kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->save();

        return response()->json([
            'status' => true,
            'message' => "Data Created successfully!",
            'kelas' => $kelas
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
        $kelas = Kelas::find($id);
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->update();

        return response()->json([
            'status' => true,
            'message' => "Data Updated successfully!",
            'kelas' => $kelas
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
        return response()->json([
            'status' => true,
            'message' => "Data Deleted successfully!",
        ]);
    }
}
