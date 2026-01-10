<?php

namespace App\Livewire\Pages\User;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class UserCreate extends Component
{
    #[Title('Create User')]
    #[Layout('components.layouts.dashboard')]

    public $username, $email, $password, $role_id;
    public $roles;

    public int $adminRoleId;
    public int $studentRoleId;

    /* ADMIN */
    public $admin_display_name;

    /* STUDENT */
    public $student_display_name;
    public $nim;
    public $class;

    public function mount()
    {
        $this->roles = Role::all();
        $this->adminRoleId = Role::where('role_code', Role::ADMIN_CODE)->value('id');
        $this->studentRoleId = Role::where('role_code', Role::STUDENT_CODE)->value('id');
    }

    public function rules()
    {
        $rules = [
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'role_id' => 'required|exists:roles,id',
        ];

        if ($this->isAdminRole()) {
            $rules['admin_display_name'] = 'required|string|max:255';
        }

        if ($this->isStudentRole()) {
            $rules['student_display_name'] = 'required|string|max:255';
            $rules['nim'] = 'required|string|max:50';
            $rules['class'] = 'required|string|max:50';
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $this->role_id,
            'is_active' => true
        ]);

        if ($this->isAdminRole()) {
            Admin::create([
                'user_id' => $user->id,
                'display_name' => $this->admin_display_name,
            ]);
        }

        if ($this->isStudentRole()) {
            Student::create([
                'user_id' => $user->id,
                'display_name' => $this->student_display_name,
                'nim' => $this->nim,
                'class' => $this->class,
            ]);
        }

        Toaster::success('User berhasil dibuat.');
        return redirect()->route('users.index');
    }

    public function isAdminRole(): bool
    {
        return (int) $this->role_id === $this->adminRoleId;
    }

    public function isStudentRole(): bool
    {
        return (int) $this->role_id === $this->studentRoleId;
    }

    public function updatedRoleId()
    {
        $this->reset([
            'admin_display_name',
            'student_display_name',
            'nim',
            'class',
        ]);
    }

    public function render()
    {
        return view('livewire.pages.user.user-create');
    }
}
