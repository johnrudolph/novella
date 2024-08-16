<?php

namespace App\Helpers;

use App\Models\Story;
use App\States\StoryState;

function currentStory(): StoryState
{
    return Story::last()->state();
}