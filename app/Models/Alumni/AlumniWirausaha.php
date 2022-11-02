<?php

namespace App\Models\Alumni;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Master\LevelUsaha;
use App\Models\Master\JenisUsaha;
use App\Models\Master\KriteriaUsaha;
use App\Models\Master\KriteriaPekerjaLepas;
use App\Models\City;

class AlumniWirausaha extends Model
{
    use HasFactory;
    protected $table = "alumni_wirausahas";
    protected $fillable = [
        'user_id',
        'nama_pemilik',
        'tanggal_mulai',
        'nama_usaha',
        'city_id',
        'penghasilan',
        'umr',
        'level_usaha_id',
        'jenis_usaha_id',
        'kriteria_usaha_id',
        'kriteria_pekerja_lepas_id',
        'tipe',
        'dijalankan_oleh'
    ];

    CONST TIPE_MEMBUKA_USAHA = 1;
    CONST TIPE_PEKERJA_LEPAS = 2;

    CONST DIJALANKAN_INDIVIDU = 1;
    CONST DIJALANKAN_BERPASANGAN = 2;

    public function tipe()
    {
        $return = null;
        switch ($this->tipe) {
            case self::TIPE_MEMBUKA_USAHA:
                $return = "Membuka Usaha";
                break;

            case self::TIPE_PEKERJA_LEPAS:
                $return = "Pekerja Lepas";
                break;
        }

        return $return;
    }

    public function dijalankan_oleh()
    {
        $return = null;
        switch ($this->dijalankan_oleh) {
            case self::DIJALANKAN_INDIVIDU:
                $return = "Individu";
                break;

            case self::DIJALANKAN_BERPASANGAN:
                $return = "Berpasangan";
                break;
        }

        return $return;
    }

    public function user()
    {
        return $this->BelongsTo(User::class,"user_id","id");
    }

    public function level_usaha()
    {
        return $this->BelongsTo(LevelUsaha::class,"level_usaha_id","id");
    }

    public function jenis_usaha()
    {
        return $this->BelongsTo(JenisUsaha::class,"jenis_usaha_id","id");
    }

    public function kriteria_usaha()
    {
        return $this->BelongsTo(KriteriaUsaha::class,"kriteria_usaha_id","id");
    }

    public function kriteria_pekerja_lepas()
    {
        return $this->BelongsTo(KriteriaPekerjaLepas::class,"kriteri_pekerja_lepas","id");
    }

    public function city()
    {
        return $this->BelongsTo(City::class,"city_id","city_id");
    }

    
}
