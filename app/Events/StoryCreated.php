<?php

namespace App\Events;

use App\Models\Story;
use Thunk\Verbs\Event;
use App\States\StoryState;
use App\Events\Traits\HasUser;
use App\Events\Traits\HasGuild;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class StoryCreated extends Event
{
    use HasUser;
    use HasGuild;

    #[StateId(StoryState::class)]
    public ?int $story_id = null;

    public string $title;

    public function applyToStory(StoryState $state)
    {
        $state->status = 'in-progress';
        $state->title = $this->title;
        $state->round_ids = collect();
        $state->canonical_submission_ids = collect();
        $state->guild_id = $this->guild_id;
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
            'guild_id' => $this->guild_id,
        ]);
    }
}
