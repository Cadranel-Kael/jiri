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
    public function hasContacts(): bool
    {
        if (auth()->user()->contacts()->count())
        {
            return false;
        }
        return true;
    }

    #[Computed]
    public function contacts()
    {
        return auth()->user()->contacts()->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->paginate($this->perPage);
    }


    public function changeOrder(): void
    {
        if ($this->order === 'ASC') {
            $this->order = 'DESC';
        } else {
            $this->order = 'ASC';
        }
    }

    public function loadMore(): void
    {
        $this->perPage += 12;
    }

    public function save(): \Illuminate\Http\RedirectResponse
    {
        $this->createContactForm->store();

        return Redirect::to(route('contacts.index'));
    }

    public function update(): \Illuminate\Http\RedirectResponse
    {
        $this->updateContactForm->update();

        return Redirect::to(route('contacts.index'));
    }

    public function toggleDeleteModule(): void
    {
        $this->deleteModuleShown = !$this->deleteModuleShown;
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $this->updateContactForm->setContact(Contact::find($id));
        $this->updateContactForm->destroy();

        return Redirect::to(route('contacts.index'));
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.contacts');
    }
}
