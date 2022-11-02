<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kompetisiPenyelenggara extends Model
{
    use HasFactory;
    protected $table = 'kompetisi_penyenggara';
    protected $fillable = [
        'id_kompetisi_penyelenggara_jenis',
        'nama_penyelenggara',
        'urutan',
    ];

    /**
     * Get the user that owns the kompetisiPenyelenggara
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kompetisiPenyelenggaraJenis(): BelongsTo
    {
        return $this->belongsTo(kompetisiPenyelenggaraJenis::class, 'id_kompetisi_penyelenggara_jenis', 'id');
    }
}
