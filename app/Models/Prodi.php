<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';
    protected $fillable = ['id_fakultas', 'id_jenjang', 'nama_prodi'];

    /**
     * Get the user that owns the Prodi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fakultas(): BelongsTo
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas', 'id');
    }

    /**
     * Get the user that owns the Prodi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenjang(): BelongsTo
    {
        return $this->belongsTo(jenjang::class, 'id_jenjang', 'id');
    }
}
