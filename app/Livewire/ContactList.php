<?php

namespace App\Livewire;

use Livewire\Component;

class ContactList extends Component
{
    public $contacts;

    public function mount($contacts)
    {
        $this->contacts = $contacts;
    }

    public function render()
    {
        return view('livewire.contact-list');
    }
}
