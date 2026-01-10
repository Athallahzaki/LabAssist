<?php

namespace App\Livewire\Pages\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class UserIndex extends Component
{
    #[Title('Users')]
    #[Layout('components.layouts.dashboard')]

    public $users;

    public function mount() {
        $this->users = User::with('role')->get();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->isAdmin() && $user->admin) {
            $user->admin->delete(); // soft delete admin
        }

        if ($user->isStudent() && $user->student) {
            $user->student->delete(); // soft delete student
        }
        $user->delete();

        $this->users = $this->users->where('id', '!=', $id);

        Toaster::success('User berhasil dihapus.');
    }

    public function toggle_active($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $this->users = $this->users->map(function ($item) use ($user) {
            if ($item->id === $user->id) {
                $item->is_active = $user->is_active;
            }
            return $item;
        });

        Toaster::success('Status user berhasil diubah.');
    }

    public function render()
    {
        return view('livewire.pages.user.user-index');
    }
}
