<?php

namespace App\States;

use Thunk\Verbs\State;
use App\States\SubmissionState;
use Illuminate\Support\Collection;

class UserState extends State
{
    public string $name;

    public int $clout;

    public Collection $submission_ids;

    public function submissions(): Collection
    {
        return $this->submission_ids->map(fn ($id) => SubmissionState::load($id));
    }
}
