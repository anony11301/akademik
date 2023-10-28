<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';

    protected $fillable = [
        'id', 'nama_kelas', 'jurusan','created_by', 'updated_by',
    ];

    protected $hidden = [];

    //FUNCTION EXPORT
    public static function getAllkelas()
    {
        $result = DB::table('kelas')
            ->select('nama_kelas')
            ->get()
            ->toArray();

        return $result;
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id');
    }

    public function data_pelanggaran()
    {
        return $this->hasMany(DataPelanggaran::class, 'id_kelas', 'id');
    }
}
