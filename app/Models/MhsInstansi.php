<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsInstansi extends Model
{
    use HasFactory; 
    protected $table = 'mhs_instansis';
    protected $fillable = ['user_id','nama','alamat','email' ,'bidang','jenis','siup','iumk','yayasan','pbh','ism'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    } 
}
