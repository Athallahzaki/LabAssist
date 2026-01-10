<?php

namespace App\Livewire\Pages\User;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class UserEdit extends Component
{
    #[Title('Edit User')]
    #[Layout('components.layouts.dashboard')]

    public User $user;
    public $username, $email, $role_id;
    public $roles;

    public int $adminRoleId;
    public int $studentRoleId;

    /* ADMIN */
    public $admin_display_name;

    /* STUDENT */
    public $student_display_name;
    public $nim;
    public $class;

    public function mount(User $user)
    {
        $this->user = $user;

        $this->username = $user->username;
        $this->email = $user->email;
        $this->role_id = $user->role_id;

        $this->roles = Role::all();
        $this->adminRoleId = Role::where('role_code', Role::ADMIN_CODE)->value('id');
        $this->studentRoleId = Role::where('role_code', Role::STUDENT_CODE)->value('id');

        // preload admin data
        if ($user->admin) {
            $this->admin_display_name = $user->admin->display_name;
        }

        // preload student data
        if ($user->student) {
            $this->student_display_name = $user->student->display_name;
            $this->nim = $user->student->nim;
            $this->class = $user->student->class;
        }
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

        // update user core data
        $this->user->update([
            'username' => $this->username,
            'email' => $this->email,
            'role_id' => $this->role_id,
        ]);

        // handle ADMIN role
        if ($this->isAdminRole()) {
            Admin::updateOrCreate(
                ['user_id' => $this->user->id],
                ['display_name' => $this->admin_display_name]
            );

            // remove student profile if exists
            Student::where('user_id', $this->user->id)->forceDelete();
        }

        // handle STUDENT role
        if ($this->isStudentRole()) {
            Student::updateOrCreate(
                ['user_id' => $this->user->id],
                [
                    'display_name' => $this->student_display_name,
                    'nim' => $this->nim,
                    'class' => $this->class,
                ]
            );

            // remove admin profile if exists
            Admin::where('user_id', $this->user->id)->forceDelete();
        }

        Toaster::success('User berhasil diperbarui.');
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

    public function render()
    {
        return view('livewire.pages.user.user-edit');
    }
}
