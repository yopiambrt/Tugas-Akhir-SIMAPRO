<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kompetisi extends Model
{
    use HasFactory;
    protected $table = 'kompetisis';
    protected $fillable = [
        'id_kegiatan_skala',
        'kepanjangan',
        'deskripsi',
        'periode',
        'akun_update',
        'akun_create',
        'keterangan',
        'id_kompetisi_penyelenggara',
        'nama',
        'kota_kabupaten',
        'register_buka',
        'pelaksanaan_awal',
        'pelaksanaan_akhir',
        'register_tutup',
        'hadiah',
        'biaya',
        'tautan'
    ];
    /**
     * Get the user that owns the kompetisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kompetisiPenyelenggara(): BelongsTo
    {
        return $this->belongsTo(kompetisiPenyelenggara::class, 'id_kompetisi_penyelenggara', 'id');
    }

    /**
     * Get the user that owns the kompetisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kegiatanSkala(): BelongsTo
    {
        return $this->belongsTo(kegiatanSkala::class, 'id_kegiatan_skala', 'id');
    }

    /**
     * Get the user that owns the kompetisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function KompetisiDaftarLabel(): BelongsTo
    {
        return $this->belongsTo(KompetisiDaftarLabel::class, 'id', 'id_kompetisi');
    }

    /**
     * Get the daftarKategori that owns the kompetisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function daftarKategori(): BelongsTo
    {
        return $this->belongsTo(KompetisiDaftarKategori::class, 'id', 'id_kompetisi');
    }
}
