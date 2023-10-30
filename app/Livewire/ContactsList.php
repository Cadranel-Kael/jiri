<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ContactsList extends Component
{
    public string $contact = '';
    public string $sort = 'name';
    public $per_page = 18;
    public $contact_form_shown = false;

    #[Computed]
    public function contacts()
    {
        return auth()->user()->load('contacts')->contacts()->where('name', 'like', '%' . $this->contact . '%')
            ->orderBy($this->sort)
            ->paginate($this->per_page);
    }

    public function load_more()
    {
        $this->per_page += 18;
    }


}
