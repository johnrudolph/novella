<?php

namespace App\Events\Traits;

use App\States\GuildState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

trait HasGuild
{
    #[StateId(GuildState::class, 'guild')]
    public int $guild_id;

    protected function guild(): GuildState
    {
        return $this->states()->get('guild');
    }
}