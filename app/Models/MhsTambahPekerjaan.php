<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsTambahPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'mhs_pekerjaan_models';
    protected $fillable = ['user_id', 'jenis','kategori','jabatan' ,'instansi','kontak','ppkwt','ppkkpw','pkkbpw','pns','pppk'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
