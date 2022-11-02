<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KompetisiPanduan extends Model
{
    use HasFactory;
    protected $table = 'kompetisi_panduan';
    protected $fillable = ['id_kompetisi', 'panduan'];

    /**
     * Get the user that owns the KompetisiPanduan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kompetisi(): BelongsTo
    {
        return $this->belongsTo(kompetisi::class, 'id_kompetisi', 'id');
    }
}
