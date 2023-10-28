<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SiswaExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id_kelas;

    public function __construct($id_kelas)
    {
        $this->id_kelas = $id_kelas;
    }

    public function view(): View
    {
        $siswa = Siswa::where('id_kelas', $this->id_kelas)->get();

        return view('export.siswa', [
            'siswa' => $siswa
        ]);
    }   
}
