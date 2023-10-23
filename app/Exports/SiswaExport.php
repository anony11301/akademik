<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


class SiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $siswa = DB::table('siswa')
            ->select('NIS', 'nama', 'poin')
            ->where('id_kelas', $this->id_kelas)
            ->get();

        return $siswa;
    
    }

    public function headings():array {
        return [
            'NIS',
            'nama',
            'poin'
        ];
    }

    protected $id_kelas;

    public function __construct($id_kelas)
    {
        $this->id_kelas = $id_kelas;
    }
}
