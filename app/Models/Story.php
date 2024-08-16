<?php

namespace App\Models;

use App\States\StoryState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function state()
    {
        return StoryState::load($this->id);
    }
}
