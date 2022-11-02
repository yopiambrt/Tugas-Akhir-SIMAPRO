<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = "cities";
    protected $fillable = [
        'id',
        'prov_id',
        'city_name'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class,"prov_id","prov_id");
    }
}
