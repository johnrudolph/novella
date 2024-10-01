<?php

namespace App\Livewire;

use App\Models\Story;
use Livewire\Component;
use Livewire\Attributes\Computed;

class StoryPage extends Component
{
    public Story $story;

    #[Computed]
    public function storyState()
    {
        return $this->story->state();
    }

    public function mount(Story $story)
    {
        $this->story = $story;

        if (! $this->story->is_public) {
            return redirect('landing-page');
        }
    }

    public function render()
    {
        return view('livewire.story-page');
    }
}
