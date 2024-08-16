<?php

namespace App\Events;

use App\States\RoundState;
use App\States\SubmissionState;
use Thunk\Verbs\Event;
use App\States\UserState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class SubmissionUpvoted extends Event
{
    #[StateId(SubmissionState::class)]
    public int $submission_id;

    #[StateId(RoundState::class)]
    public int $round_id;

    #[StateId(UserState::class)]
    public int $author_id;

    public int $voter_id;

    public int $story_id;

    public function applyToUser(UserState $state)
    {
        $state->clout += 1;
    }

    public function applyToSubmission(SubmissionState $state)
    {
        $state->score += 1;
    }
}
