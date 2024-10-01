<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'guild_users');
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}
