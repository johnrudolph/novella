<?php

namespace App\Events;

use Thunk\Verbs\Event;
use App\States\RoundState;
use App\States\StoryState;
use App\Events\Traits\HasGuild;
use App\Events\Traits\HasRound;
use App\Events\Traits\HasStory;
use App\States\SubmissionState;

class RoundEnded extends Event
{
    use HasStory;
    use HasRound;
    use HasGuild;

    public function validate()
    {
        $this->assert(
            $this->state(RoundState::class)->submission_ids->count() > 0,
            'No submissions yet'
        );
    }

    public function applyToStory(StoryState $state)
    {
        $state->canonical_submission_ids->push($this->state(RoundState::class)->winner()->id);
    }

    public function applyToRound(RoundState $state)
    {
        $state->status = 'complete';
    }

    public function fired()
    {
        $last_entry = SubmissionState::load($this->state(StoryState::class)->canonical_submission_ids->last());

        if ($last_entry->type === 'new_story') {
            StoryCreated::fire(
                user_id: $last_entry->user_id,
                title: $last_entry->content,
                guild_id: $this->guild_id,
            );

            return;
        }

        // @todo just do this in the command when we end a round??
        RoundCreated::fire(story_id: $this->story_id);
    }

    public function handle()
    {
        $this->roundModel()->update([
            'status' => 'complete',
        ]);
    }
}
