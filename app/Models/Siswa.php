<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'NIS';

    protected $fillable = [
        'NIS', 
        'nama',
        'id_kelas',
        'poin'
    ];

    protected $hidden = [

    ];

    public static function getAllsiswa($id_kelas) {
        $result = DB::table('siswa')
            ->select('NIS','nama', 'poin')
            ->get()
            ->toArray();

        return $result;
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function absen()
    {
        return $this->hasMany(Absensi::class, 'NIS', 'NIS');
    }

    public function data_pelanggaran()
    {
        return $this->hasMany(DataPelanggaran::class, 'NIS', 'NIS');
    }
}
