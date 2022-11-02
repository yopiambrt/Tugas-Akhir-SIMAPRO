<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class prestasi extends Model
{
    use HasFactory;

    protected $table = 'kompetisi_mahasiswas';
    protected $fillable = ['user_id', 'id_kompetisi', 'team', 'id_kompetisi_hasil', 'status', 'tanggal_upload'];

    /**
     * Get the user that owns the prestasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the kompetisi that owns the prestasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kompetisi(): BelongsTo
    {
        return $this->belongsTo(kompetisi::class, 'id_kompetisi', 'id');
    }

    /**
     * Get the user that owns the prestasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hasil(): BelongsTo
    {
        return $this->belongsTo(KompetisiMahasiswaHasil::class, 'id_kompetisi_hasil', 'id');
    }
}
