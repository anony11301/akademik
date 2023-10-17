<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggaran';

    protected $fillable = [
        'nis',
        'id_pelanggaran',
        'tanggal',
    ];

    protected $hidden = [

    ];
}
