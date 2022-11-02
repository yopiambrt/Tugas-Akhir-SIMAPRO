<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPekerjaan extends Model
{
    use HasFactory;
    protected $table = "master_status_pekerjaans";
    protected $fillable = [
        'id',
        'nama',
    ];

    CONST BELUM_BEKERJA = 1;
    CONST BEKERJA = 2;
    CONST MEMBUKA_USAHA = 3;
    CONST STUDI_LANJUT = 4;
}
