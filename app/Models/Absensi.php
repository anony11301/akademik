<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

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
}
