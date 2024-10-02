<?php

namespace App\Events;

use App\Models\User;
use Thunk\Verbs\Event;
use App\States\UserState;
use App\Events\Traits\HasUser;

class UserNameUpdated extends Event
{
    use HasUser;

    public string $name;

    public function apply(UserState $state)
    {
        $state->name = $this->name;
    }

    public function handle()
    {
        User::find($this->user_id)->update([
            'name' => $this->name,
        ]);
    }
}
