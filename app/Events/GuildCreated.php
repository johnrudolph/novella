<?php

namespace App\Events;

use App\Models\Guild;
use App\States\GuildState;
use Thunk\Verbs\Event;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class GuildCreated extends Event
{
    #[StateId(GuildState::class)]
    public ?int $guild_id = null;

    public string $name;

    public string $motto;

    public bool $is_public;

    public bool $is_open;

    public function apply(GuildState $state)
    {
        $state->name = $this->name;
        $state->user_ids = collect();
        $state->admin_ids = collect();
        $state->submission_ids = collect();
        $state->is_public = $this->is_public;
        $state->is_open = $this->is_open;
        $state->motto = $this->motto;
    }

    public function handle()
    {
        Guild::create([
            'id' => $this->guild_id,
            'name' => $this->name,
            'is_public' => $this->is_public,
            'is_open' => $this->is_open,
            'motto' => $this->motto,
        ]);
    }
}
