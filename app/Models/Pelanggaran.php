<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggaran';

    protected $fillable = [
        'nama_pelanggaran',
        'poin',
    ];

    protected $hidden = [

    ];

    public function data_pelanggaran()
    {
        return $this->hasMany(DataPelanggaran::class, 'id_pelanggaran', 'id');
    }
}
