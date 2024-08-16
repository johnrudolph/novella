<?php

namespace App\Events\Traits;

use App\States\SubmissionState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

trait HasSubmission
{
    #[StateId(SubmissionState::class, 'submission')]
    public int $submission_id;

    protected function submission(): SubmissionState
    {
        return $this->states()->get('submission');
    }
}