<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPekerjaan extends Model
{
    use HasFactory;
    protected $table = "master_kategori_pekerjaans";
    protected $fillable = [
        'id',
        'nama',
    ];
}
