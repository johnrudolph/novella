<?php

namespace App\Livewire;

use App\Models\Guild;
use App\Models\Story;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class StoryPage extends Component
{
    public Story $story;

    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    #[Computed]
    public function storyState()
    {
        return $this->story->state();
    }

    public function mount(Guild $guild, Story $story)
    {
        $this->story = $story;

        $guild_is_public = $guild->is_public;
        $user_is_in_guild = $guild->users->pluck('id')->contains($this->user->id);

        if (! $guild_is_public && ! $user_is_in_guild) {
            return redirect('dashboard');
        }
    }

    public function render()
    {
        return view('livewire.story-page');
    }
}
