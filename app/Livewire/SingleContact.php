<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SingleContact extends Component
{
    public int $id;
    public $name, $email;

    #[Computed]
    public function contact()
    {
        return auth()->user()->contacts()->where('id', $this->id)->first();
    }

    #[Computed]
    public function name()
    {
        $this->name = $this->contact()->name;
    }

    #[Computed]
    public function email()
    {
        $this->email = $this->contact()->email;
    }

    #[Computed]
    public function events()
    {
        return $this->contact()->events->load('projects')->load('presentations');
    }

    public function getProjectAverage($event_id, $project_id, $total = 100)
    {
        return round($this
                ->events
                ->where('id', $event_id)
                ->first()
                ->presentations()
                ->where('project_id', $project_id)
                ->first()
                ->scores
                ->pluck('score')
                ->avg() / 100 * $total);
    }

    public function getAverage($event_id, $total = 100)
    {
        foreach ($this->events->where('id', $event_id)->first()->projects as $project) {
            $scores[] = $this->getProjectAverage($event_id, $project->id) * $project->pivot->weight;
        }

        return round(array_sum($scores) / count($scores) / 100 * $total);
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

    public function update()
    {
        $this->validate();

        auth()->user()->contacts()->where('id', $this->id)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        return Redirect::to(route('contacts.show', ['contact' => $this->contact->id]));
    }

    public function render()
    {
        return view('livewire.single-contact');
    }
}
