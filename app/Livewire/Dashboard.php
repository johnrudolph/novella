<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    #[Computed]
    public function guilds()
    {
        return $this->user->guilds;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
