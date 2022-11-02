<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KompetisiDaftarKategori extends Model
{
    use HasFactory;
    protected $table = 'kompetisi_daftar_kategori';
    protected $fillable = ['id_kompetisi', 'id_kompetisi_kategori'];

    /**
     * Get the user that owns the KompetisiDaftarKategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kompetisi(): BelongsTo
    {
        return $this->belongsTo(kompetisi::class, 'id_kompetisi', 'id');
    }

    /**
     * Get the user that owns the KompetisiDaftarKategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Kategori(): BelongsTo
    {
        return $this->belongsTo(KompetisiKategori::class, 'id_kompetisi_kategori', 'id');
    }
}
