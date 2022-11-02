<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetisiPoster extends Model
{
    use HasFactory;

    protected $table = 'kompetisi_poster';
    protected $fillable = ['id_kompetisi', 'poster'];
}
