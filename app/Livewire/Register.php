<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use Livewire\Component;

class Register extends Component
{
    public UserForm $form;

    public function save()
    {
        $this->form->store();
    }

    public function render()
    {
        return view('livewire.register');
    }
}
