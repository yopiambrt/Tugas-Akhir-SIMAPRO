<?php

namespace App\Models\Alumni;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Master\UniversitasJenjang;
use App\Models\Master\UniversitasKategori;
use App\Models\Master\UniversitasLevel;

class AlumniStudiLanjut extends Model
{
    use HasFactory;
    protected $table = "alumni_studi_lanjuts";
    protected $fillable = [
        'user_id',
        'nama',
        'tanggal_mulai',
        'nama_universitas',
        'univ_jenjang_id',
        'univ_kategori_id',
        'univ_level_id',
        'program_studi',
        'fakultas',
    ];

    public function user()
    {
        return $this->BelongsTo(User::class,"user_id","id");
    }

    public function universitas_jenjang()
    {
        return $this->BelongsTo(UniversitasJenjang::class,"univ_jenjang_id","id");
    }

    public function universitas_kategori()
    {
        return $this->BelongsTo(UniversitasKategori::class,"univ_kategori_id","id");
    }

    public function universitas_level()
    {
        return $this->BelongsTo(UniversitasLevel::class,"univ_level_id","id");
    }
    
}
