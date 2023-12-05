<?php

namespace App\Livewire\Forms;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateContactForm extends Form
{
    public ?Contact $contact;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    public function setContact(Contact $contact)
    {
        $this->contact = $contact;

        $this->name = $contact->name;

        $this->email = $contact->email;
    }

    public function store()
    {
        $this->validate();

        $this->contact = Auth::user()
            ->contacts()
            ->save(new Contact($this->all()));

        return $this->contact;
    }

    public function update()
    {
        $this->validate();

        $this->contact->update($this->all());
    }
}
