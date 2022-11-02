<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KompetisiDaftarLabel extends Model
{
    use HasFactory;
    protected $table = 'kompetisi_daftar_label';
    protected $fillable = ['id_kompetisi', 'id_kompetisi_label'];

    /**
     * Get the kompetisi that owns the KompetisiDaftarLabel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kompetisi(): BelongsTo
    {
        return $this->belongsTo(kompetisi::class, 'id_kompetisi', 'id');
    }

    /**
     * Get the user that owns the KompetisiDaftarLabel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function KompetisiLabel(): BelongsTo
    {
        return $this->belongsTo(KompetisiLabel::class, 'id_kompetisi_label', 'id');
    }
}
