<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kompetisiPenyelenggaraJenis extends Model
{
    use HasFactory;
    protected $table = 'kompetisi_penyenggara_jenis';
    protected $fillable = [
        'jenis_penyelenggara',
        'urutan'
    ];
}
