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
    public $name, $email, $currentName, $currentEmail;

    #[Url(as: 's')]
    public $search = '';

    public string $sort = 'name';
    public string $order = 'ASC';
    public array $sortableBy = ['name', 'email', 'created_at'];

    public $perPage = 12;
    public $contactFormShown = false;

    #[Url]
    public $id = '1';

    #[Computed]
    public function contacts()
    {
        return auth()->user()->load('contacts')->contacts()->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->paginate($this->perPage);
    }

    #[Computed]
    public function currentName()
    {
        $this->currentName = auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first()->name;
        return auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first()->name;
    }

    #[Computed]
    public function currentEmail()
    {
        $this->currentEmail = auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first()->email;
        return auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first()->email;
    }

    public function changeOrder()
    {
        if ($this->order === 'ASC')
        {
            $this->order = 'DESC';
        } else {
            $this->order = 'ASC';
        }
    }

    public function loadMore()
    {
        $this->per_page += 12;
    }

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

    public function save()
    {
        $this->validate();

        Auth::user()->contacts()->save(new Contact([
            'name' => $this->name,
            'email' => $this->email,
        ]));

        return Redirect::to(route('contacts.index'));
    }

    public function update()
    {
        $this->name = $this->currentName;
        $this->email = $this->currentEmail;

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
