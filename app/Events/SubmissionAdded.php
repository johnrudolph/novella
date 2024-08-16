<?php

namespace App\Events;

use Thunk\Verbs\Event;
use App\States\UserState;
use App\States\RoundState;
use App\Events\Traits\HasUser;
use App\Events\Traits\HasRound;
use App\Events\Traits\HasStory;
use App\States\SubmissionState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class SubmissionAdded extends Event
{
    use HasUser;
    use HasRound;
    use HasStory;

    #[StateId(SubmissionState::class)]
    public ?int $submission_id = null;

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

        $state->created_at = now();
    }

    public function applyToRound(RoundState $state)
    {
        $state->submission_ids->push($this->submission_id);
    }
}
