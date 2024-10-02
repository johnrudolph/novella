<?php

namespace App\States;

use Thunk\Verbs\State;
use Illuminate\Support\Collection;

class RoundState extends State
{
    public int $story_id;

    public string $status;

    public Collection $submission_ids;

    public function story(): StoryState
    {
        return StoryState::load($this->story_id);
    }

    public function submissions(): Collection
    {
        return $this->submission_ids->map(fn ($id) => SubmissionState::load($id));
    }

    public function winner(): ?SubmissionState
    {
        return $this->submissions()->sortByDesc('applause')->first();
    }
}
