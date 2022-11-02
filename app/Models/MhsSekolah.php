<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsSekolah extends Model
{
    use HasFactory;
    protected $table = 'mhs_sekolah';
    protected $fillable = ['user_id', 'nim', 'jenis_sekolah_atas', 'nama_sekolah_atas', 'nama_smp', 'nama_sd'];
}
