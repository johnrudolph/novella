<?php

namespace App\Events;

use App\Events\Traits\HasGuild;
use App\Events\Traits\HasUser;
use Thunk\Verbs\Event;
use App\States\GuildState;

class UserPromotedToGuildAdmin extends Event
{
    use HasUser;
    use HasGuild;

    public function applyToGuild(GuildState $state)
    {
        $state->admin_ids->push($this->user_id);
    }
}
