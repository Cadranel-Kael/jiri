<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class ContactLivewireController extends Component
{
    public $name, $email, $currentName, $currentEmail, $deleteModuleShown = false;

    #[Url(as: 's')]
    public $search = '';

    public string $sort = 'name';
    public string $order = 'ASC';
    public array $sortables = ['name', 'email', 'created_at'];

    public $perPage = 12;
    public $contactFormShown = false;

    #[Url]
    public $id = '';

    #[Computed]
    public function contacts()
    {
        return auth()->user()->contacts()->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->paginate($this->perPage);
    }

    #[Computed]
    public function currentContact()
    {
        if ($this->id) {
            return auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first();
        }
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
        $this->perPage += 12;
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
        if (!Gate::allows('handle-contact', $this->currentContact())) {
            abort(403);
        }

        $this->name = $this->currentName;
        $this->email = $this->currentEmail;

        $this->validate();

        Auth::user()->contacts()->where('id', $this->id)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        return Redirect::to(route('contacts.index'));
    }

    public function toggleDeleteModule()
    {
        $this->deleteModuleShown = !$this->deleteModuleShown;
    }

    public function destroy($id)
    {
        if (!Gate::allows('handle-contact', $this->contacts()->where('id', $id)->first())) {
            abort(403);
        }

        Auth::user()->contacts()->where('id', $id)->delete();

        return Redirect::to(route('contacts.index'));
    }

    public function render()
    {
        return view('livewire.contacts');
    }
}
