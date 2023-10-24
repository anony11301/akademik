<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'NIS' => $row['NIS'],
            'nama' => $row['nama'],
            'id_kelas' => $row['id_kelas'],
        ]);
    }
}
