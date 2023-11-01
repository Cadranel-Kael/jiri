<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ContactsList extends Component
{
    public $name = '';
    public $email = '';

    public string $contact = '';
    public string $sort = 'name';
    public $per_page = 18;
    public $contact_form_shown = false;

    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|email',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __('form.full_name'),
            'email' => __('form.email'),
        ];
    }

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

    public function save()
    {
        $this->validate();

        Auth::user()->contacts()->save(new Contact([
            'name' => $this->name,
            'email' => $this->email,
        ]));

        return Redirect::to(URL::route('contacts.index'));
    }


}
