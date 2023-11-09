<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ContactLivewireController extends Component
{
    public $name, $email;

    #[Url(as: 's')]
    public $search = '';

    public string $sort = 'name';
    public string $order = 'ASC';
    public array $sortable_by = ['name', 'email', 'created_at'];

    public $per_page = 18;
    public $contact_form_shown = false;

    #[Url]
    public $id = '1';

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
        return auth()->user()->load('contacts')->contacts()->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->paginate($this->per_page);
    }

    #[Computed]
    public function name()
    {
        return auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first()->name;
    }

    #[Computed]
    public function email()
    {
        return auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first()->email;
    }

    public function change_order()
    {
        if ($this->order === 'ASC')
        {
            $this->order = 'DESC';
        } else {
            $this->order = 'ASC';
        }
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

        return Redirect::to(route('contacts.index'));
    }

    public function edit()
    {
        $this->validate();

        Auth::user()->contacts()->where('id', $this->id)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        return Redirect::to(route('contacts.index'));
    }

    public function render()
    {
        return view('livewire.contacts');
    }
}
