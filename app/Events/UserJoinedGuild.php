<?php

namespace App\Events;

use App\Events\Traits\HasGuild;
use App\Events\Traits\HasUser;
use App\Models\User;
use App\Models\Guild;
use Thunk\Verbs\Event;
use App\States\UserState;
use App\States\GuildState;

class UserJoinedGuild extends Event
{
    use HasUser;
    use HasGuild;

    public function applyToGuild(GuildState $state)
    {
        $state->user_ids->push($this->user_id);
    }

    public function applyToUser(UserState $user)
    {
        $user->guild_ids->push($this->guild_id);
        $user->current_guild_id = $this->guild_id;
    }

    public function handle()
    {
        Guild::find($this->guild_id)->users()->attach($this->user_id);

        User::find($this->user_id)->update([
            'current_guild_id' => $this->guild_id,
        ]);
    }
}
