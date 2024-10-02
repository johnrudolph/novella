<?php

namespace App\Events;

use App\Models\User;
use Thunk\Verbs\Event;
use App\States\UserState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class UserCreated extends Event
{
    #[StateId(UserState::class)]
    public ?int $user_id = null;

    public string $name;

    public string $email;

    public string $encrypted_password;

    public function apply(UserState $state)
    {
        $state->name = $this->name;
        $state->applause = 0;
        $state->submission_ids = collect();
        $state->guild_ids = collect();
    }

    public function handle()
    {
        User::create([
            'id' => $this->user_id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->encrypted_password,
        ]);
    }
}
