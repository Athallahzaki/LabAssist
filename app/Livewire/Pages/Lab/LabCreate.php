<?php

namespace App\Livewire\Pages\Lab;

use App\Models\Lab;
use App\Models\Status;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class LabCreate extends Component
{
    #[Title('Create Lab')]

    public $lab_name;
    public $capacity;
    public $lab_status_id;
    public $statuses;

    public function mount() {
        $this->statuses = Status::group('lab')->get();
    }

    public function rules()
    {
        return [
            'lab_name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'lab_status_id' => 'required|exists:statuses,id',
        ];
    }

    public function save()
    {
        $this->validate();

        Lab::create([
            'lab_name' => $this->lab_name,
            'capacity' => $this->capacity,
            'lab_status_id' => $this->lab_status_id,
        ]);

        Toaster::success('Lab berhasil dibuat.');

        return redirect()->route('labs.index');
    }

    public function render()
    {
        return view('livewire.pages.lab.lab-create')
        ->layout('components.layouts.dashboard');
    }
}
