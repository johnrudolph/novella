<?php

namespace App\Livewire;

use App\Models\Guild;
use Livewire\Component;
use App\Events\StoryCreated;
use Thunk\Verbs\Facades\Verbs;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class CreateStoryPage extends Component
{
    #[Validate('required', message: 'Please provide a title')]
    #[Validate('max:70', message: 'The name must be less than 70 characters')]
    public string $title;

    public int $guild_id;

    #[Computed]
    public function guild()
    {
        return Guild::find($this->guild_id);
    }

    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    public function mount(int $guild)
    {
        $this->guild_id = $guild;

        if($this->guild->stories->count() > 0) {
            $this->redirect(route('guild.show', $this->guild_id));
        }
    }

    public function create()
    {
        $this->validate();

        $story_id = StoryCreated::fire(
            guild_id: $this->guild->id,
            user_id: $this->user->id,
            title: $this->title,
        )->story_id;

        Verbs::commit();

        $this->redirect(route('story.show', ['guild' => $this->guild->id, 'story' => $story_id]));
    }

    public function render()
    {
        return view('livewire.create-story-page');
    }
}
