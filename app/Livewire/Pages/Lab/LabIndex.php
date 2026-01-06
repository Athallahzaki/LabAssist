<?php

namespace App\Livewire\Pages\Lab;

use Livewire\Component;

class LabIndex extends Component
{
    public function render()
    {
        $labs = \App\Models\Lab::with('status')->get();
        return view('livewire.pages.lab.lab-index', [
            'labs' => $labs
        ])
        ->layout('components.layouts.dashboard');
    }
}
