<?php

namespace App\Livewire\Pages\Lab;

use App\Models\Lab;
use App\Models\Status;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class LabEdit extends Component
{
        #[Title('Edit Lab')]

    public Lab $lab;
    public $lab_name;
    public $capacity;
    public $lab_status_id;
    public $statuses;

    public function mount(Lab $lab)
    {
        $this->lab = $lab;
        $this->lab_name = $lab->lab_name;
        $this->capacity = $lab->capacity;
        $this->lab_status_id = $lab->lab_status_id;
        $this->statuses = Status::where('group', 'lab')->get();
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

        $this->lab->update([
            'lab_name' => $this->lab_name,
            'capacity' => $this->capacity,
            'lab_status_id' => $this->lab_status_id,
        ]);

        Toaster::success('Lab berhasil diubah.');

        return redirect()->route('labs.index');
    }

    public function render()
    {
        return view('livewire.pages.lab.lab-edit')
        ->layout('components.layouts.dashboard');
    }
}
