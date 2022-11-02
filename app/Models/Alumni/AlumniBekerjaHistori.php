<?php

namespace App\Models\Alumni;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Master\JenisPerusahaan;
use App\Models\Master\LevelInstansi;
use App\Models\Master\KategoriPekerjaan;
use App\Models\City;

class AlumniBekerjaHistori extends Model
{
    use HasFactory;
    protected $table = "alumni_bekerja_histories";
    protected $fillable = [
        'user_id',
        'jenis_perusahaan_id',
        'nama',
        'tanggal_mulai',
        'nama_instansi',
        'city_id',
        'gaji_pertama',
        'umr',
        'jenis_pekerjaan',
        'jabatan',
        'contact',
        'kategori_pekerjaan_id',
        'level_instansi_id',
        'pkwt',
        'pkwtt',
        'pbh',
        'lsm',
        'siup',
        'yayasan',
        'pns',
        'pppk',
    ];

    CONST PKWT_YES = 1;
    CONST PKWT_NO = 0;

    CONST PKWTT_YES = 1;
    CONST PKWTT_NO = 0;

    CONST PBH_YES = 1;
    CONST PBH_NO = 0;

    CONST LSM_YES = 1;
    CONST LSM_NO = 0;

    CONST SIUP_YES = 1;
    CONST SIUP_NO = 0;

    CONST YAYASAN_YES = 1;
    CONST YAYASAN_NO = 0;

    CONST PNS_YES = 1;
    CONST PNS_NO = 0;

    CONST PPPK_YES = 1;
    CONST PPPK_NO = 0;

    public function pkwt()
    {
        $return = null;
        switch ($this->pkwt) {
            case self::PKWT_YES:
                $return = "Ya";
                break;

            case self::PKWT_NO:
                $return = "Tidak";
                break;
        }

        return $return;
    }

    public function pkwtt()
    {
        $return = null;
        switch ($this->pkwtt) {
            case self::PKWTT_YES:
                $return = "Ya";
                break;

            case self::PKWTT_NO:
                $return = "Tidak";
                break;
        }

        return $return;
    }

    public function pbh()
    {
        $return = null;
        switch ($this->pbh) {
            case self::PBH_YES:
                $return = "Ya";
                break;

            case self::PBH_NO:
                $return = "Tidak";
                break;
        }

        return $return;
    }

    public function lsm()
    {
        $return = null;
        switch ($this->lsm) {
            case self::LSM_YES:
                $return = "Ya";
                break;

            case self::LSM_NO:
                $return = "Tidak";
                break;
        }

        return $return;
    }

    public function siup()
    {
        $return = null;
        switch ($this->siup) {
            case self::SIUP_YES:
                $return = "Ya";
                break;

            case self::SIUP_NO:
                $return = "Tidak";
                break;
        }

        return $return;
    }

    public function yayasan()
    {
        $return = null;
        switch ($this->yayasan) {
            case self::YAYASAN_YES:
                $return = "Ya";
                break;

            case self::YAYASAN_NO:
                $return = "Tidak";
                break;
        }

        return $return;
    }

    public function pns()
    {
        $return = null;
        switch ($this->pns) {
            case self::PNS_YES:
                $return = "Ya";
                break;

            case self::PNS_NO:
                $return = "Tidak";
                break;
        }

        return $return;
    }

    public function pppk()
    {
        $return = null;
        switch ($this->pppk) {
            case self::PPPK_YES:
                $return = "Ya";
                break;

            case self::PPPK_NO:
                $return = "Tidak";
                break;
        }

        return $return;
    }

    public function user()
    {
        return $this->BelongsTo(User::class,"user_id","id");
    }

    public function jenis_perusahaan()
    {
        return $this->BelongsTo(JenisPerusahaan::class,"jenis_perusahaan_id","id");
    }

    public function level_instansi()
    {
        return $this->BelongsTo(LevelInstansi::class,"level_instansi_id","id");
    }

    public function kategori_pekerjaan()
    {
        return $this->BelongsTo(KategoriPekerjaan::class,"kategori_pekerjaan_id","id");
    }

    public function city()
    {
        return $this->BelongsTo(City::class,"city_id","city_id");
    }

    
}
