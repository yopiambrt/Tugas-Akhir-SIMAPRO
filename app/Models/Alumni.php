<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Alumni\AlumniWirausaha;
use App\Models\Alumni\AlumniBekerja;
use App\Models\Alumni\AlumniStudiLanjut;
use App\Models\Master\StatusPekerjaan;

class Alumni extends Model
{
    use HasFactory;

    protected $table = "alumnis";
    protected $fillable = [
        'user_id', 
        'status_kelulusan',
        'tanggal_lulus',
        'tanggal_terbit_ijasah',
        'upload_foto_ijasah',
        'status_verifikasi',
        'status_pekerjaan_id',
    ];

    CONST STATUS_KELULUSAN_YES = 1;
    CONST STATUS_KELULUSAN_NO = 0;

    CONST STATUS_VERIFIKASI_YES = 1;
    CONST STATUS_VERIFIKASI_NO = 0;
    CONST STATUS_VERIFIKASI_TOLAK = 2;

    public function status_kelulusan()
    {
        $return = null;
        switch ($this->status_kelulusan) {
            case self::STATUS_KELULUSAN_YES:
                $return = "Lulus";
            break;
            case self::STATUS_KELULUSAN_NO:
                $return = "Belum Lulus";
            break;
        }

        return $return;
    }

    public function status_verifikasi()
    {
        $return = null;
        switch ($this->status_verifikasi) {
            case self::STATUS_VERIFIKASI_YES:
                $return = (object) [
                    'class' => 'success',
                    'msg' => 'Data anda berhasil diverifikasi admin',
                ];
                break;

            case self::STATUS_VERIFIKASI_NO:
                $return = (object) [
                    'class' => 'secondary',
                    'msg' => 'Data anda sedang diverifikasi admin',
                ];
                break;

            case self::STATUS_VERIFIKASI_TOLAK:
                $return = (object) [
                    'class' => 'success',
                    'msg' => 'Data anda ditolak admin',
                ];

                break;
        }

        return $return;
    }

    /**
     * Get the user that owns the Alumni
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the user that owns the Alumni
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kerja(): BelongsTo
    {
        return $this->belongsTo(AlumniKerja::class, 'user_id', 'user_id');
    }

    /**
     * Get the kuliah that owns the Alumni
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kuliah(): BelongsTo
    {
        return $this->belongsTo(AlumniKuliah::class, 'user_id', 'user_id');
    }

    public function status_pekerjaan()
    {
        return $this->belongsTo(StatusPekerjaan::class, 'status_pekerjaan_id', 'id');
    }

    public function alumni_wirausaha()
    {
        return $this->belongsTo(AlumniWirausaha::class, 'user_id', 'user_id');
    }

    public function alumni_bekerja()
    {
        return $this->belongsTo(AlumniBekerja::class, 'user_id', 'user_id');
    }

    public function alumni_studi_lanjut()
    {
        return $this->belongsTo(AlumniStudiLanjut::class, 'user_id', 'user_id');
    }
}
