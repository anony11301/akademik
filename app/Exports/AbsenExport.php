<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsenExport implements FromVIew, ShouldAutoSize
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
        $absen = Absensi::where('id_kelas', $this->id_kelas)->get();

        return view('export.absen', [
            'absen' => $absen
        ]);
    }
}
