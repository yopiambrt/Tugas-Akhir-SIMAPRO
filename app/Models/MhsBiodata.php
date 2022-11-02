<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsBiodata extends Model
{
    use HasFactory;
    protected $table = "mhs_biodatas";
    protected $fillable = [
        'id',
        'user_id',
        'nama',
        'email',
        'nim',
        'jk',
        'agama_id',
        'tempat_lahir',
        'tanggal_lahir',
        'city_id',
        'alamat',
        'pendidikan_terakhir',
        'kelas',
        'tahun_masuk'
    ];

    const JK_PRIA = "L";
    const JK_PEREMPUAN = "P";

    public function jk()
    {
        $return = null;
        switch ($this->jk) {
            case self::JK_PRIA:
                $return = "Laki-Laki";
            break;
            case self::JK_PEREMPUAN:
                $return = "Perempuan";
            break;
        }

        return $return;
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class,"agama_id","id");
    }

    public function city_birth()
    {
        return $this->belongsTo(City::class,"tempat_lahir","city_id");
    }

    public function city_address()
    {
        return $this->belongsTo(City::class,"city_id","city_id");
    }

    public function keluarga()
    {
        return $this->belongsTo(DataKeluarga::class,"user_id","user_id");
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class,"user_id","user_id");
    }


}
