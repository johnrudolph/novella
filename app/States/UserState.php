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

    public Collection $guild_ids;

    public int $current_guild_id;

    public function guilds(): Collection
    {
        return $this->guild_ids->map(fn($id) => GuildState::load($id));
    }

    public function currentGuild(): GuildState
    {
        return GuildState::load($this->current_guild_id);
    }

    public function submissions(): Collection
    {
        return $this->submission_ids->map(fn ($id) => SubmissionState::load($id));
    }
}
