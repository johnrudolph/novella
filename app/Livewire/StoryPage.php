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

    public string $new_submission;

    public string $value = '';

    public string $quillId;

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

    #[Computed]
    public function round()
    {
        return $this->story->currentRound();
    }

    #[Computed]
    public function allSubmissions()
    {
        return $this->round->submissions;
    }

    #[Computed]
    public function userSubmission()
    {
        return $this->all_submissions->firstWhere('user_id', $this->user->id);
    }

    public function mount(Guild $guild, Story $story)
    {
        $this->story = $story;

        $guild_is_public = $guild->is_public;
        $user_is_in_guild = $guild->users->pluck('id')->contains($this->user->id);

        $this->quillId = 'quill-'.uniqid();

        if (! $guild_is_public && ! $user_is_in_guild) {
            return redirect('dashboard');
        }
    }

    public function submit()
    {
        dd($this->new_submission);
    }

    public function updatedValue($value)
    {
        $this->new_submission = $value;
    }

    public function render()
    {
        return view('livewire.story-page');
    }
}
