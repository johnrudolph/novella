<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Guild;
use Livewire\Component;
use App\States\GuildState;
use App\Events\GuildUpdated;
use App\Events\StoryCreated;
use Thunk\Verbs\Facades\Verbs;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class GuildPage extends Component
{
    use \Livewire\WithPagination;

    public int $guild_id;

    public bool $is_public;

    public bool $is_open;

    #[Validate('required', message: 'Please provide a name')]
    #[Validate('max:40', message: 'The name must be less than 40 characters')]
    public string $name;

    #[Validate('required', message: 'Please provide a motto')]
    #[Validate('max:250', message: 'The motto must be less than 250 characters')]
    public string $motto;

    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    #[Computed]
    public function isAdmin()
    {
        return $this->guild->state()->admin_ids->contains($this->user->id);
    }

    #[Computed]
    public function guild()
    {
        return Guild::find($this->guild_id);
    }

    #[Computed]
    public function guildState()
    {
        return GuildState::load($this->guild_id);
    }

    #[Computed]
    public function stories()
    {
        return $this->guild->stories;
    }

    #[Computed]
    public function writers()
    {
        return $this->guild->users;
    }

    public function mount(int $guild)
    {
        $this->guild_id = $guild;
        $this->is_open = $this->guild->is_open;
        $this->is_public = $this->guild->is_public;
        $this->motto = $this->guild->motto;
        $this->name = $this->guild->name;
    }

    public function updateGuild()
    {
        $this->validate();

        GuildUpdated::fire(
            guild_id: $this->guild->id,
            name: $this->name,
            motto: $this->motto,
            is_public: $this->is_public,
            is_open: $this->is_open,
        );

        Verbs::commit();

        $this->guild->refresh();

        Flux::toast('Your changes have been saved.');
    }

    public function render()
    {
        return view('livewire.guild-page');
    }
}
