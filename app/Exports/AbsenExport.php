<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\GuruController;

class AbsenExport implements FromCollection, withHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return collect(GuruController::export());
    //     // return Kelas::all();
    // }

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // $absen = $this->data['absen'];
        // $siswa = $this->data['siswa'];
        // $kelas_id = $this->data['kelas_id'];
        // $request = $this->data['request'];
        // $persentasi_kehadiran = $this->data['persentasi_kehadiran'];

        // $collection = [];

        // foreach ($absen as $key => $value) {
        //     $siswaData = isset($siswa[$value->siswa_id]) ? $siswa[$value->siswa_id] : null;

        //     if ($siswaData) {
        //         $collection[] = [
        //             $key + 1,  // Nomor
        //             $siswaData->nis,  // NIS
        //             $siswaData->nama,  // Nama Siswa
        //             $value->status,  // Status
        //             $value->keterangan,  // Keterangan
        //             $value->tanggal,  // Tanggal
        //         ];
        //     }
        // }

        return $this->data;

    }

    public function headings():array {
        return [
            'Nomor',
            'NIS',
            'Nama Siswa',
            'Nama Kelas',
            'Status',
            'Keterangan',
            'Tanggal',
        ];
    }
}
