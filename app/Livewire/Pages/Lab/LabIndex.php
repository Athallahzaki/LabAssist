<?php

namespace App\Livewire\Pages\Lab;

use App\Models\Lab;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class LabIndex extends Component
{
        #[Title('Labs')]

    public $labs;

    public function mount() {
        $this->labs = Lab::with('status')->get();
    }

    public function delete($id)
    {
        $lab = Lab::findOrFail($id);
        $lab->delete();

        $this->labs = $this->labs->where('id', '!=', $id);

        Toaster::success('Lab berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.pages.lab.lab-index')
        ->layout('components.layouts.dashboard');
    }
}
