<?php

namespace App\Models;

use App\States\StoryState;
use Glhd\Bits\Database\HasSnowflakes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory, HasSnowflakes;

    protected $guarded = [];

    public function state()
    {
        return StoryState::load($this->id);
    }

    public function guild()
    {
        return $this->belongsTo(Guild::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function currentRound()
    {
        return $this->rounds->last();
    }
}
