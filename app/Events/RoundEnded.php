<?php

namespace App\Events;

use Thunk\Verbs\Event;
use App\States\RoundState;
use App\States\StoryState;
use App\States\SubmissionState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class RoundEnded extends Event
{
    #[StateId(RoundState::class)]
    public int $round_id;

    #[StateId(StoryState::class)]
    public int $story_id;

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
                title: $last_entry->content
            );

            return;
        }

        RoundCreated::fire(story_id: $this->story_id);
    }
}
