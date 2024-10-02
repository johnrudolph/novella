<?php

namespace App\Events\Traits;

use App\Models\User;
use App\States\UserState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

trait HasUser
{
    #[StateId(UserState::class, 'user')]
    public int $user_id;

    protected function user(): UserState
    {
        return $this->states()->get('user');
    }

    public function userModel(): User
    {
        return User::find($this->user_id);
    }
}