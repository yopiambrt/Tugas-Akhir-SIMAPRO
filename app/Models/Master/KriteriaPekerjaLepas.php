<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPekerjaLepas extends Model
{
    use HasFactory;
    protected $table = "master_kriteria_pekerja_lepas";
    protected $fillable = [
        'id',
        'nama',
    ];
}
