<?php

namespace App\Exports;

use Illuminate\Contracts\View\VIew;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\DataPelanggaran;

class DataPelanggaranExport implements FromView, ShouldAutoSize
{
     /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): VIew
    {
        return view('export.datapelanggaran', [
            'data_pelanggaran' => DataPelanggaran::all()
        ]);
    }
}
