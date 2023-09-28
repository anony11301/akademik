<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';

    protected $fillable = [
        'id', 'nama_kelas', 'jurusan',
    ];

    protected $hidden = [

    ];

    //FUNCTION EXPORT
    public static function getAllkelas() {
        $result = DB::table('kelas')
        ->select('id','nama_kelas')
        ->get()->toArray();
        return $result;
    }
}
