<?php

namespace App\States;

use Carbon\Carbon;
use Thunk\Verbs\State;
use Illuminate\Support\Collection;

class SubmissionState extends State
{
    public int $user_id;

    public int $story_id;

    public int $applause = 0;

    public Collection $upvoter_ids;

    public Carbon $created_at;

    public string $type;

    public string $content;

    public function author()
    {
        return UserState::load($this->user_id);
    }

    public function story()
    {
        return StoryState::load($this->story_id);
    }
}
