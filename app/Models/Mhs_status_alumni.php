<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mhs_status_alumni extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status_alumni'];

    // public function user(): BelongsToMany
    // {
    //     return $this->belongsToMany(user::class, 'user_id', 'id');
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
