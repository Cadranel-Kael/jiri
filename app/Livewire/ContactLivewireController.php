<?php

namespace App\Livewire;

use App\Livewire\Forms\ContactForm;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class ContactLivewireController extends Component
{
    public $deleteModuleShown = false;

    #[Url(as: 's')]
    public $search = '';

    public string $sort = 'name';
    public string $order = 'ASC';
    public array $sortables = ['name', 'email', 'created_at'];

    public $perPage = 12;

    public contactForm $createContactForm;
    public contactForm $updateContactForm;

    #[Url]
    public $id = '';

    public function mount()
    {
        if ($this->id) {
            $this->updateContactForm->setContact(Contact::find($this->id));
        }
    }

    #[Computed]
    public function contacts()
    {
        return auth()->user()->contacts()->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->paginate($this->perPage);
    }


    public function changeOrder()
    {
        if ($this->order === 'ASC') {
            $this->order = 'DESC';
        } else {
            $this->order = 'ASC';
        }
    }

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function save()
    {
        $this->createContactForm->store();

        return Redirect::to(route('contacts.index'));
    }

    public function update()
    {
        $this->updateContactForm->update();

        return Redirect::to(route('contacts.index'));
    }

    public function toggleDeleteModule()
    {
        $this->deleteModuleShown = !$this->deleteModuleShown;
    }

    public function destroy($id)
    {
        $this->updateContactForm->setContact(Contact::find($id));
        $this->updateContactForm->destroy();

        return Redirect::to(route('contacts.index'));
    }

    public function render()
    {
        return view('livewire.contacts');
    }
}
