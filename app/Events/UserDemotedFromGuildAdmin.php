<?php

namespace App\Events;

use App\Events\Traits\HasGuild;
use App\Events\Traits\HasUser;
use Thunk\Verbs\Event;
use App\States\GuildState;

class UserDemotedFromGuildAdmin extends Event
{
    use HasUser;
    use HasGuild;

    public function applyToGuild(GuildState $state)
    {
        $state->admin_ids = $state->admin_ids
            ->reject(fn($u) => $u === $this->user_id);
    }
}
