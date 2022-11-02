<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kegiatanSkala extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_skala';
    protected $fillable = ['skala'];
}
