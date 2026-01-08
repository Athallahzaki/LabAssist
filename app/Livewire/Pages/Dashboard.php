<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
        #[Title("Home")]

    public function render()
    {
        return view('livewire.pages.dashboard')
            ->layout('components.layouts.dashboard');
    }
}
