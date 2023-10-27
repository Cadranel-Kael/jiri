<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ContactsList extends Component
{
    public string $username = '';
    public string $sort = 'name';

    #[Computed]
    public function contacts()
    {
        return Contact::where('name', 'like', '%' . $this->username . '%')->orderBy($this->sort)->get();
    }
}
