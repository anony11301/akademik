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

    private $id_kelas;

    public function __construct($id_kelas)
    {
        $this->id_kelas = $id_kelas;
    }

    public function model(array $row)
    {
        return new Siswa([
            'NIS' => $row[1],
            'nama' => $row[2],
            'id_kelas' => $this->id_kelas,
        ]);
    }
}
