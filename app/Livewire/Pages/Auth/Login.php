<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Login extends Component
{
    #[Title('Login')]

    // login
    public $email, $password;

    public function switchMode() {
        return redirect()->route('register');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            
            Toaster::error('Email atau Password Salah!');
            return;
        }

        session()->regenerate();

        Toaster::success('Login Berhasil!');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.pages.auth.login')
            ->layout('components.layouts.auth');
    }
}
