<?php

namespace App\Events\Traits;

use App\States\StoryState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

trait HasStory
{
    #[StateId(StoryState::class, 'story')]
    public int $story_id;

    protected function story(): StoryState
    {
        return $this->states()->get('story');
    }
}