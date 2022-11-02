<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = "provinces";
    protected $fillable = [
        'id',
        'prov_name',
    ];

    public function city()
    {
        return $this->hasMany(City::class,"id","city_id");
    }
}
