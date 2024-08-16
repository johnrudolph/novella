<?php

namespace App\Events;

use Thunk\Verbs\Event;
use App\States\RoundState;
use App\States\StoryState;
use App\Events\Traits\HasStory;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class RoundCreated extends Event
{
    use HasStory;

    #[StateId(RoundState::class)]
    public ?int $round_id = null;

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
