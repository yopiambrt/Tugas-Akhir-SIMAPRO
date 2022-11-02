<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetisiKategori extends Model
{
    use HasFactory;
    protected $table = 'kompetisi_kategori';
    protected $fillable = ['nama_kategori', 'urutan'];
}
