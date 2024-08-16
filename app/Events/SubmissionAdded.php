<?php

namespace App\Events;

use App\States\RoundState;
use App\States\StoryState;
use App\States\SubmissionState;
use Thunk\Verbs\Event;
use App\States\UserState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class SubmissionAdded extends Event
{
    #[StateId(SubmissionState::class)]
    public ?int $submission_id = null;

    #[StateId(RoundState::class)]
    public int $round_id;

    #[StateId(UserState::class)]
    public int $user_id;

    public int $story_id;

    public string $content;

    public string $type;

    public function validate()
    {
        $this->assert(
            $this->type === 'paragraph' || $this->type === 'new_chapter' || $this->type === 'new_story', 
            'Invalid submission type'
        );
    }

    public function applyToUser(UserState $state)
    {
        $state->submission_ids->push($this->submission_id);
    }

    public function applyToSubmission(SubmissionState $state)
    {
        $state->user_id = $this->user_id;

        $state->story_id = $this->story_id;

        $state->type = $this->type;

        $state->content = $this->content;

        $state->score = 0;

        $state->upvoter_ids = collect();

        $state->downvoter_ids = collect();
    }

    public function applyToRound(RoundState $state)
    {
        $state->submission_ids->push($this->submission_id);
    }
}
