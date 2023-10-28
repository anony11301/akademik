<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
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
        // Mengecek bahwa baris saat ini lebih besar dari baris judul, yang ingin dihindari
        if ($this->startRow > 1) {
            // Mengembalikan model data siswa hanya jika baris saat ini adalah data aktual
            return new Siswa([
                'NIS' => $row[1],
                'nama' => $row[2],
                'id_kelas' => $this->id_kelas,
            ]);
        }
        return null;
    }
}

