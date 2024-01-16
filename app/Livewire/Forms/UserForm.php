<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;

    #[Validate('required|min:3', attribute: ['name' => 'nom et prénom'])]
    public $name = '';

    #[Validate('required|email', attribute: ['email' => 'email'])]
    public $email = '';

    #[Validate('required|min:8', attribute: ['password' => 'mot de passe'])]
    public $password = '';

    public function store()
    {
        $this->validate();

        $this->user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($this->user);

        return redirect(RouteServiceProvider::HOME);
    }
}
