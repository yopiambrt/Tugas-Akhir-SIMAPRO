<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPerusahaan extends Model
{
    use HasFactory;
    protected $table = "master_jenis_perusahaans";
    protected $fillable = [
        'id',
        'nama',
    ];

    CONST SWASTA = 1;
    CONST NIRLABA = 2;
    CONST MULTILATERAL = 3;
    CONST LEMBAGA_PEMERINTAH = 4;
    CONST BUMN = 5;
    CONST BUMD = 6;
}
