<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetisiLabel extends Model
{
    use HasFactory;
    protected $table = 'kompetisi_label';
    protected $fillable = ['nama_label'];
}
