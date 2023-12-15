<?php

namespace App\Livewire;

use App\Livewire\Forms\EventForm;
use App\Models\Event;
use Livewire\Attributes\Computed;
use Livewire\Component;

class EventLivewireController extends Component
{
    public $search = '';
    public $sort = 'date';
    public $perPage = 18;
    public array $sortables = ['name', 'email', 'created_at'];

    public EventForm $form;

    #[Computed]
    public function events()
    {
        return auth()
            ->user()
            ->events()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, 'desc')
            ->paginate($this->perPage);
    }

    public function delete($id)
    {
        $this->form->setEvent(Event::where('id', $id)->firstOrFail());
        $this->form->destroy();
    }

    public function render()
    {
        return view('livewire.events');
    }
}
