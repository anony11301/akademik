<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'NISN';
    protected $casts = [
        'NISN' => 'string',
        ];

    protected $fillable = [
        'NISN',
        'nama',
        'id_kelas',
        'poin',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [];

    public static function getAllsiswa($id_kelas)
    {
        $result = DB::table('siswa')
            ->select('NISN', 'nama', 'poin')
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
        return $this->hasMany(Absensi::class, 'NISN', 'NISN');
    }

    public function data_pelanggaran()
    {
        return $this->hasMany(DataPelanggaran::class, 'NISN', 'NISN');
    }
}
