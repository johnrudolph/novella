<?php

namespace App\Events\Traits;

use App\States\RoundState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

trait HasRound
{
    #[StateId(RoundState::class, 'round')]
    public int $round_id;

    protected function round(): RoundState
    {
        return $this->states()->get('round');
    }
}