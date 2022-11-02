<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelInstansi extends Model
{
    use HasFactory;
    protected $table = "master_level_instansis";
    protected $fillable = [
        'id',
        'nama',
    ];
}
