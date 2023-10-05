<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsenExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Absensi::getAllabsen());
        // return Kelas::all();
    }

    public function headings():array {
        return [
            'Nomor',
            'NIS',
            'Nama Siswa',
            'Status',
            'Keterangan',
            'Tanggal',
        ];
    }
}
