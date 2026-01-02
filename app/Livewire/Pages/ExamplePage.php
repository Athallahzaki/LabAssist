<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ExamplePage extends Component
{
    #[Title("Test")]

    public function test() {
        Toaster::success('Test Success!!');
        Toaster::info('Hello ' . auth()->user()->username);
    }

    public function render()
    {
        return view('livewire.pages.example-page')
            ->layout('components.layouts.dashboard');
    }
}
