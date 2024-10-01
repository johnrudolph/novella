<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class LandingPage extends Component
{
    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    public function mount()
    {
        if ($this->user) {
            return redirect('dashboard');
        }
    }

    public function render()
    {
        return view('livewire.landing-page');
    }
}
