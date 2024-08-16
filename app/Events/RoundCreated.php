<?php

namespace App\Events;

use App\States\RoundState;
use App\States\StoryState;
use Thunk\Verbs\Event;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class RoundCreated extends Event
{
    #[StateId(RoundState::class)]
    public ?int $round_id = null;

    #[StateId(StoryState::class)]
    public int $story_id;

    public function applyToStory(StoryState $state)
    {
        $state->round_ids->push($this->round_id);
    }

    public function applyToRound(RoundState $state)
    {
        $state->story_id = $this->story_id;
        $state->status = 'in-progress';
        $state->submission_ids = collect();
    }
}
