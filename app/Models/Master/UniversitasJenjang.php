<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversitasJenjang extends Model
{
    use HasFactory;
    protected $table = "master_universitas_jenjangs";
    protected $fillable = [
        'id',
        'nama',
    ];
}
