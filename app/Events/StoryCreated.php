<?php

namespace App\Events;

use App\Models\Story;
use Thunk\Verbs\Event;
use App\States\StoryState;
use App\States\UserState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class StoryCreated extends Event
{
    #[StateId(StoryState::class)]
    public ?int $story_id = null;

    #[StateId(UserState::class)]
    public int $user_id;

    public string $title;

    public function applyToStory(StoryState $state)
    {
        $state->status = 'in-progress';
        $state->title = $this->title;
        $state->round_ids = collect();
        $state->canonical_submission_ids = collect();
    }

    public function fired()
    {
        RoundCreated::fire(story_id: $this->story_id);
    }

    public function handle()
    {
        Story::create([
            'id' => $this->story_id,
            'title' => $this->title,
            'status' => 'in-progress',
        ]);
    }
}
