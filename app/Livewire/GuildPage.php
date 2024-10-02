<?php

namespace App\Livewire;

use App\Models\Guild;
use Livewire\Component;
use App\States\GuildState;
use App\Events\GuildUpdated;
use Thunk\Verbs\Facades\Verbs;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class GuildPage extends Component
{
    use \Livewire\WithPagination;

    public int $guild_id;

    public bool $is_public;

    public bool $is_open;

    public string $name;

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
        GuildUpdated::fire(
            guild_id: $this->guild->id,
            name: $this->name,
            motto: $this->motto,
            is_public: $this->is_public,
            is_open: $this->is_open,
        );

        Verbs::commit();

        $this->guild->refresh();
    }

    public function render()
    {
        return view('livewire.guild-page');
    }
}
