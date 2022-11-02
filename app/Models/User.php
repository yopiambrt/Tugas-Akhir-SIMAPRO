<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Alumni\AlumniBekerja;
use App\Models\Alumni\AlumniWirausaha;
use App\Models\Alumni\AlumniStudiLanjut;
use App\Models\Alumni\AlumniBekerjaHistori;
use App\Models\Alumni\AlumniWirausahaHistori;
use App\Models\Alumni\AlumniStudiLanjutHistori;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_active',
        'avatar',
    ];

    CONST IS_ACTIVE_YES = 1;
    CONST IS_ACTIVE_NO = 0;

    CONST ROLE_ADMIN = 1;
    CONST ROLE_PEGAWAI = 3;
    CONST ROLE_MAHASISWA = 4;

    public function is_active()
    {
        $return = null;
        switch ($this->is_active) {
            case self::IS_ACTIVE_YES:
                $return = "Aktif";
                break;

            case self::IS_ACTIVE_NO:
                $return = "Tidak Aktif";
                break;
        }

        return $return;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'is_admin', 'is_admin');
    }

    /**
     * Get the alamat that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alamat(): BelongsTo
    {
        return $this->belongsTo(AlamatMhs::class, 'id', 'user_id');
    }

    /**
     * Get the sekolah that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(MhsSekolah::class, 'id', 'user_id');
    }

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataKeluarga(): BelongsTo
    {
        return $this->belongsTo(dataKeluarga::class, 'id', 'user_id');
    }

    public function Mhs_status_alumni(): BelongsTo
    {
        return $this->belongsTo(Mhs_status_alumni::class, 'id', 'user_id');
    }

    public function MhsPekerjaanModel(): BelongsTo
    {
        return $this->belongsTo(MhsPekerjaanModel::class, 'id', 'user_id');
    }
    public function MhsTambahPekerjaan(): BelongsTo
    {
        return $this->belongsTo(MhsTambahPekerjaan::class, 'id', 'user_id');
    }
    public function AlumniTambah(): BelongsTo
    {
        return $this->belongsTo(MhsTambahPekerjaan::class, 'id', 'user_id');
    }
    public function MhsKategoriPekerjaan(): BelongsTo
    {
        return $this->belongsTo(MhsTambahPekerjaan::class, 'id', 'user_id');
    }

    public function biodata()
    {
        return $this->belongsTo(MhsBiodata::class, 'id', 'user_id');
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id', 'user_id');
    }

    public function alumni_bekerja()
    {
        return $this->belongsTo(AlumniBekerja::class, 'id', 'user_id');
    }

    public function alumni_wirausaha()
    {
        return $this->belongsTo(AlumniWirausaha::class, 'id', 'user_id');
    }

    public function alumni_studi_lanjut()
    {
        return $this->belongsTo(AlumniStudiLanjut::class, 'id', 'user_id');
    }

    public function alumni_bekerja_histori()
    {
        return $this->hasMany(AlumniBekerjaHistori::class, 'user_id', 'id');
    }

    public function alumni_wirausaha_histori()
    {
        return $this->hasMany(AlumniWirausahaHistori::class, 'user_id', 'id');
    }

    public function alumni_studi_lanjut_histori()
    {
        return $this->hasMany(AlumniStudiLanjutHistori::class, 'user_id', 'id');
    }
}
