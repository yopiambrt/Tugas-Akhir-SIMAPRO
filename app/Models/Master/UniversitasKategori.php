<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversitasKategori extends Model
{
    use HasFactory;
    protected $table = "master_universitas_kategoris";
    protected $fillable = [
        'id',
        'nama',
    ];
}
