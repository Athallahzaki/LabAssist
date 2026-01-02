<?php

namespace App\Livewire\Pages\Auth;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Register extends Component
{
    #[Title('Register')]

    // register
    public $username, $nim, $class, $reg_email, $reg_password;

    public function switchMode() {
        return redirect()->route('login');
    }

    public function register()
    {
        $this->validate([
            'username' => 'required|unique:users,username',
            'reg_email' => 'required|email|unique:users,email',
            'reg_password' => 'required|min:8',
            'nim' => 'required|unique:students,nim',
            'class' => 'required',
        ]);

        $studentRole = Role::where('role_code', Role::STUDENT_CODE)->first();

        DB::transaction(function () use ($studentRole){
            $user = User::create([
                'username' => $this->username,
                'email' => $this->reg_email,
                'password' => Hash::make($this->reg_password),
                'role_id' => $studentRole->id,
                'is_active' => true,
            ]);

            Student::create([
                'user_id' => $user->id,
                'nim' => $this->nim,
                'display_name' => $this->username,
                'class' => $this->class,
            ]);

            Auth::login($user);
        });

        Toaster::success('Registrasi Berhasil!');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.pages.auth.register')
            ->layout('components.layouts.auth');
    }
}
