<?php

namespace App\Events\Traits;

use App\Models\Submission;
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

    public function submissionModel(): Submission
    {
        return Submission::find($this->submission_id);
    }
}