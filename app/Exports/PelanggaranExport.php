<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Models\DataPelanggaran;

class PelanggaranExport implements FromCollection, WithHeadings
{
     /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return collect(GuruController::export());
    //     // return Kelas::all();
    // }

    public function collection()
    {
        // Query untuk menggabungkan data dari tiga tabel
        return collect(DataPelanggaran::getAllPelanggaran());
    }
    public function headings():array {
        return [
            'No',
            'Nama',
            'Kelas',
            'Pelanggaran',
            'Poin',
            'Tanggal',
        ];
    }
}
