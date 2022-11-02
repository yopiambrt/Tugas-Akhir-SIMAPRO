<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Pendidikan;

class DataKeluarga extends Model
{
    use HasFactory;
    protected $table = 'mhs_keluarga';
    protected $fillable = ['user_id', 'nim', 'ibu_nama', 'ibu_alamat', 'ibu_gaji', 'ibu_telepon', 'ibu_pendidikan_id', 'ibu_pekerjaan', 'ibu_gaji', 'ayah_nama', 'ayah_alamat', 'ayah_telepon', 'ayah_pendidikan_id', 'ayah_pekerjaan', 'ayah_gaji', 'kakak_jumlah', 'adik_jumlah'];

    public function pendidikan_ayah()
    {
        return $this->belongsTo(Pendidikan::class,"ayah_pendidikan_id","id");
    }

    public function pendidikan_ibu()
    {
        return $this->belongsTo(Pendidikan::class,"ibu_pendidikan_id","id");
    }
}
