<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;

class ManagementController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();

        return view('pages.management.dashboard',[
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahKelas' => $jumlahKelas,
        ]
    );
    }
}
