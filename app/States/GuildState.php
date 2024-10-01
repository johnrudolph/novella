<?php

namespace App\States;

use Thunk\Verbs\State;
use App\States\SubmissionState;
use Illuminate\Support\Collection;

class GuildState extends State
{
    public string $name;

    public Collection $user_ids;

    public Collection $admin_ids;

    public Collection $submission_ids;

    public bool $is_public;

    public bool $is_open;

    public function users(): Collection
    {
        return $this->user_ids->map(fn ($id) => UserState::load($id));
    }

    public function admins(): Collection
    {
        return $this->admin_ids->map(fn ($id) => UserState::load($id));
    }

    public function submissions(): Collection
    {
        return $this->submission_ids->map(fn ($id) => SubmissionState::load($id));
    }
}
