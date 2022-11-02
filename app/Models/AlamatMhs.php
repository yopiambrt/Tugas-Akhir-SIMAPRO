<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AlamatMhs extends Model
{
    use HasFactory;

    protected $table = 'mhs_alamat';
    protected $fillable = ['user_id', 'nim', 'alamat_status', 'alamat_tinggal'];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(user::class, 'user_id', 'id');
    }
}
