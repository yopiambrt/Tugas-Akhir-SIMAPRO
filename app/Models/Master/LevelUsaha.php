<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelUsaha extends Model
{
    use HasFactory;
    protected $table = "master_level_usahas";
    protected $fillable = [
        'id',
        'nama',
    ];
}
