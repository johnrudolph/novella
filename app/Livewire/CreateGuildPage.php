<?php

namespace App\Livewire;

use Livewire\Component;
use App\Events\GuildCreated;
use App\Events\UserJoinedGuild;
use App\Events\UserPromotedToGuildAdmin;
use Thunk\Verbs\Facades\Verbs;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class CreateGuildPage extends Component
{
    public bool $is_public = false;

    public bool $is_open = false;

    #[Validate('required', message: 'Please provide a name (you can change this later)')]
    #[Validate('max:40', message: 'The name must be less than 40 characters')]
    public string $name;

    #[Validate('required', message: 'Please provide a motto (you can change this later)')]
    #[Validate('max:250', message: 'The motto must be less than 250 characters')]
    public string $motto;

    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    public function create()
    {
        $this->validate();

        $guild_id = GuildCreated::fire(
            name: $this->name,
            motto: $this->motto,
            is_public: $this->is_public,
            is_open: $this->is_open,
        )->guild_id;

        UserJoinedGuild::fire(
            guild_id: $guild_id,
            user_id: $this->user->id,
        );

        UserPromotedToGuildAdmin::fire(
            guild_id: $guild_id,
            user_id: $this->user->id,
        );

        Verbs::commit();

        $this->redirect(route('guild.show', $guild_id));
    }

    public function render()
    {
        return view('livewire.create-guild-page');
    }
}
