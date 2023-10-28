<?php

namespace App\Exports;

use App\Models\Pelanggaran;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PelanggaranExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.pelanggaran', [
            'pelanggaran' => Pelanggaran::all()
        ]);
    }
}
