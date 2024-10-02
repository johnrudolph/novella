<?php

namespace App\Models;

use App\Models\Guild;
use App\Models\Story;
use Glhd\Bits\Database\HasSnowflakes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Round extends Model
{
    use HasFactory, HasSnowflakes;

    protected $guarded = [];

    public function story(): Story
    {
        return $this->belongsTo(Story::class);
    }
}
