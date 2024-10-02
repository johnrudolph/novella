<?php

namespace App\Events;

use Thunk\Verbs\Event;
use App\States\UserState;
use App\Events\Traits\HasUser;
use App\Events\Traits\HasRound;
use App\States\SubmissionState;
use App\Events\Traits\HasSubmission;

class SubmissionUpvoted extends Event
{
    use HasSubmission;
    use HasRound;
    use HasUser;

    public int $voter_id;

    public int $story_id;

    public function applyToUser(UserState $state)
    {
        $state->applause += 1;
    }

    public function applyToSubmission(SubmissionState $state)
    {
        $state->applause += 1;
    }

    public function handle()
    {
        $this->userModel()->update([
            'applause' => $this->user()->applause,
        ]);

        $this->submissionModel()->update([
            'applause' => $this->submission()->applause,
        ]);
    }
}
