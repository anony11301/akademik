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
        'id_kelas'
    ];

    protected $hidden = [

    ];

    public static function getAllsiswa() {
        $result = DB::table('siswa')
            ->select('NIS','nama','id_kelas')
            ->get()
            ->toArray();

        return $result;
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
}
