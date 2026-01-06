<?php

namespace App\Livewire\Pages\Lab;

use App\Models\Lab;
use App\Models\Status;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LabCreate extends Component
{
    public $lab_name;
    public $capacity;
    public $lab_status_id;

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

        return redirect()->route('labs.index');
    }

    public function render()
    {
        $statuses = Status::group('lab')->get();
        return view('livewire.pages.lab.lab-create', [
            'statuses' => $statuses
        ])
        ->layout('components.layouts.dashboard');
    }
}
