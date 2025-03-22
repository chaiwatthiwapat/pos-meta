<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $name = '';
    public string $password = '';

    public function login() {
        $credentials = [
            'name' => $this->name,
            'password' => $this->password,
        ];

        if(Auth::attempt($credentials)) {
            session()->regenerate();
            return $this->redirectRoute('home.index', navigate: true);
        } 
        else {
            $this->addError('name', 'ชื่อ หรือรหัสผ่านไม่ถูกต้อง');
        }
    }

    public function logout() {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
