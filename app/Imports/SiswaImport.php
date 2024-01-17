<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    private $id_kelas;
    private $startRow;

    public function __construct($id_kelas, $startRow = 2)
    {
        $this->id_kelas = $id_kelas;
        $this->startRow = $startRow;
    }

    public function model(array $row)
    {
        if ($this->startRow <= 1) {
            return null;
        }

        return new Siswa([
            'NISN' => $row['nisn'],
            'nama' => $row['nama'],
            'id_kelas' => $this->id_kelas,
        ]);
    }
}
