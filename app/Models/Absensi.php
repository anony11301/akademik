<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'absen'; // Nama tabel absensi di database

    protected $fillable = [
        'NIS', // Kolom NIS sebagai foreign key
        'id_kelas', // Kolom id_kelas sebagai foreign key
        'tanggal',
        'status', // Kolom status (hadir, sakit, izin)
        'keterangan', // Kolom keterangan
    ];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }

    // Relasi ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public static function getAllabsen() {
        $result = DB::table('absen')
            ->join('siswa', 'absen.NIS', '=', 'siswa.NIS')
            ->select('absen.id','absen.NIS', 'siswa.nama', 'absen.status', 'absen.keterangan', 'absen.tanggal')
            ->get()
            ->toArray();
    
        return $result;
    }
}
