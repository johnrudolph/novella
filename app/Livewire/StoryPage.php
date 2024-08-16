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
    }

    public function render()
    {
        return view('livewire.story-page');
    }
}
