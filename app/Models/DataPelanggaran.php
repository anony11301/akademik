<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggaran';

    protected $fillable = [
        'NIS',
        'id_pelanggaran',
        'tanggal',
        'id_kelas',
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
}
