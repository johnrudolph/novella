<?php

namespace App\Livewire;

use App\Models\Guild;
use Livewire\Component;
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

    public function mount(int $guild_id)
    {
        $this->guild_id = $guild_id;
    }

    public function render()
    {
        return view('livewire.create-new-story');
    }
}
