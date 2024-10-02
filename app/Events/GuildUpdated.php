<?php

namespace App\Events;

use App\Events\Traits\HasGuild;
use App\Models\Guild;
use App\States\GuildState;
use Thunk\Verbs\Event;

class GuildUpdated extends Event
{
    use HasGuild;

    public string $name;

    public string $motto;

    public bool $is_public;

    public bool $is_open;

    public function apply(GuildState $state)
    {
        $state->name = $this->name;
        $state->is_public = $this->is_public;
        $state->is_open = $this->is_open;
        $state->motto = $this->motto;
    }

    public function handle()
    {
        Guild::find($this->guild_id)->update([
            'name' => $this->name,
            'is_public' => $this->is_public,
            'is_open' => $this->is_open,
            'motto' => $this->motto,
        ]);
    }
}
