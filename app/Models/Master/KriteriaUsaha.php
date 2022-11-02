<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaUsaha extends Model
{
    use HasFactory;
    protected $table = "master_kriteria_usahas";
    protected $fillable = [
        'id',
        'nama',
    ];
}
