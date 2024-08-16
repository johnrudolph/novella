<?php

namespace App\States;

use Thunk\Verbs\State;
use Illuminate\Support\Collection;

class StoryState extends State
{
    public string $title;

    public string $status;

    public Collection $canonical_submission_ids;

    public Collection $round_ids;

    public bool $is_public;

    public Collection $user_ids;

    public function rounds(): Collection
    {
        return $this->round_ids->map(fn ($id) => RoundState::load($id));
    }

    public function currentRound(): RoundState
    {
        return RoundState::load($this->round_ids->last());
    }

    public function canon(): Collection
    {
        return $this->canonical_submission_ids->map(fn ($id) => SubmissionState::load($id));
    }
}
