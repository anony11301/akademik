<?php

namespace App\Exports;

use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KelasExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Kelas::getAllkelas());
        // return Kelas::all();
    }

    public function headings():array {
        return [
            'Nomor',
            'Nama Kelas',
        ];
    }
}
