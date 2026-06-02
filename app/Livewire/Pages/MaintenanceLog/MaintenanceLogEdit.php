<?php

namespace App\Livewire\Pages\MaintenanceLog;

use App\Models\MaintenanceLog;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class MaintenanceLogEdit extends Component
{
    #[Title('Edit Maintenance Log')]
    
    public MaintenanceLog $maintenanceLog;
    public $description = '';

    protected $rules = [
        'description' => 'required|string|min:5',
    ];

    public function mount(MaintenanceLog $maintenanceLog)
    {
        abort_unless(
            $maintenanceLog->canBeEditedBy(auth()->user()->admin),
            403
        );

        $this->maintenanceLog = $maintenanceLog;

        $this->description = $maintenanceLog->description;
    }

    public function save()  
    {
        abort_unless(
            $this->maintenanceLog->canBeEditedBy(auth()->user()->admin),
            403
        );

        $this->validate();

        $this->maintenanceLog->update([
            'description' => $this->description,
        ]);

        Toaster::success('Maintenance log berhasil diperbarui.');

        return redirect()->route('maintenance-logs.index');
    }

    public function render()
    {
        return view(
            'livewire.pages.maintenance-log.maintenance-log-edit'
        )->layout('components.layouts.dashboard');
    }
}
