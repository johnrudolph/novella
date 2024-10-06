<?php

namespace App\Models;

use App\Models\Story;
use App\States\SubmissionState;
use Glhd\Bits\Database\HasSnowflakes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Round extends Model
{
    use HasFactory, HasSnowflakes;

    protected $guarded = [];

    public function state()
    {
        return SubmissionState::load($this->id);
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
