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
    protected $id_kelas, $dari, $sampai, $filter;

    public function __construct($id_kelas, $dari, $sampai, $filter)
    {
        $this->id_kelas = $id_kelas;
        $this->dari = $dari;
        $this->sampai = $sampai;
        $this->filter = $filter;
    }

    public function view(): View
    {
        if($this->filter == null) {
            $absen = Absensi::where('id_kelas', $this->id_kelas)->whereBetween('tanggal', [$this->dari, $this->sampai])->get();
        } else {
            $absen = Absensi::where('id_kelas', $this->id_kelas)->whereBetween('tanggal', [$this->dari, $this->sampai])->where('status', $this->filter)->get();
        }

        return view('export.absen', [
            'absen' => $absen
        ]);
    }
}
