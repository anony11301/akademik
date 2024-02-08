<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggaran';
    protected $casts = [
        'NISN' => 'string',
        ];

    protected $fillable = [
        'NISN',
        'id_pelanggaran',
        'tanggal',
        'id_kelas',
        'created_by',
        'keterangan'
    ];

    protected $hidden = [];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NISN', 'NISN');
    }

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }


    public static function getAllPelanggaran()
    {
        $data = DB::table('data_pelanggaran')
            ->join('pelanggaran', 'data_pelanggaran.id', '=', 'pelanggaran.nama_pelanggaran')
            ->join('siswa', 'data_pelanggaran.NISN', '=', 'siswa.NISN')
            ->join('kelas', 'data_pelanggaran.id_kelas', '=', 'kelas.id')
            ->select('data_pelanggaran.id', 'siswa.nama', 'kelas.nama_kelas', 'pelanggaran.nama_pelanggaran', 'pelanggaran.poin', 'data_pelanggaran.tanggal')
            ->get()
            ->toArray();

        return $data;
    }
}
