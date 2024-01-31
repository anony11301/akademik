<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absen'; // Nama tabel absensi di database
    protected $primaryKey = 'NISN';
    protected $casts = [
        'NISN' => 'string',
        ];

    protected $fillable = [
        'NISN', // Kolom NISN sebagai foreign key
        'id_kelas', // Kolom id_kelas sebagai foreign key
        'tanggal',
        'status', // Kolom status (hadir, sakit, izin)
        'keterangan', // Kolom keterangan
        'created_by',
    ];

    protected $hidden = [];

    public static function getAllabsen($id_kelas)
    {
        $result = DB::table('absen')
            ->join('siswa', 'absen.NISN', '=', 'siswa.NISN')
            ->join('kelas', 'absen.id_kelas', '=', 'kelas.nama_kelas')
            ->select('absen.id', 'absen.NISN', 'siswa.nama', 'absen.status', 'absen.keterangan', 'absen.id_kelas', 'absen.tanggal')
            ->get()
            ->toArray();

        return $result;
    }

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NISN', 'NISN');
    }

    // Relasi ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
}
