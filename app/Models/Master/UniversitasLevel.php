<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversitasLevel extends Model
{
    use HasFactory;
    protected $table = "master_universitas_levels";
    protected $fillable = [
        'id',
        'nama',
    ];
}
