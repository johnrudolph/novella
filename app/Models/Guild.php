<?php

namespace App\Models;

use App\States\GuildState;
use Glhd\Bits\Database\HasSnowflakes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guild extends Model
{
    use HasFactory, HasSnowflakes;

    protected $guarded = [];

    public function state(): GuildState
    {
        return GuildState::load($this->id);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'guild_users');
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}
