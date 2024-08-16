<?php

namespace App\Events;

use App\Models\Story;
use Thunk\Verbs\Event;
use App\States\StoryState;
use App\Events\Traits\HasUser;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class StoryCreated extends Event
{
    use HasUser;

    #[StateId(StoryState::class)]
    public ?int $story_id = null;

    public string $title;

    public ?bool $is_public = true;

    public function applyToStory(StoryState $state)
    {
        $state->status = 'in-progress';
        $state->title = $this->title;
        $state->round_ids = collect();
        $state->canonical_submission_ids = collect();
        $state->is_public = $this->is_public;

        if (! $this->is_public) {
            $state->user_ids->push($this->user_id);
        }
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
            'is_public' => $this->is_public,
        ]);
    }
}
