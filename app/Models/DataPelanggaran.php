<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggaran';

    protected $fillable = [
        'NIS',
        'id_pelanggaran',
        'tanggal',
        'id_kelas',
        'created_by',
    ];

    protected $hidden = [

    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }


    public static function getAllPelanggaran() {
        $data = DB::table('data_pelanggaran')
            ->join('pelanggaran', 'data_pelanggaran.id', '=', 'pelanggaran.id')
            ->join('siswa', 'data_pelanggaran.NIS', '=', 'siswa.NIS')
            ->join('kelas', 'data_pelanggaran.id_kelas', '=', 'kelas.id')
            ->select('data_pelanggaran.id', 'siswa.nama', 'kelas.nama_kelas', 'pelanggaran.nama_pelanggaran as nama_pelanggaran', 'pelanggaran.poin', 'data_pelanggaran.tanggal')
            ->get()
            ->toArray();
    
        return $data;
    }
    
}
