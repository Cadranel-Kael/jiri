<?php

namespace App\Livewire;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProjectsLivewireController extends Component
{

    #[Url(as: 's')]
    public $search = '';

    #[Url]
    public $id = '1';

    public string $sort = 'title';
    public string $order = 'ASC';
    public array $sortables = ['title', 'created_at'];

    public $perPage = 12;

    #[Computed]
    public function projects()
    {
        return auth()->user()->load('projects')->projects()->where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->paginate($this->perPage);
    }

//    #[Computed]
//    public function currentName()
//    {
//        $this->currentName = auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first()->name;
//        return auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first()->name;
//    }
//
//    #[Computed]
//    public function currentEmail()
//    {
//        $this->currentEmail = auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first()->email;
//        return auth()->user()->load('contacts')->contacts()->where('id', $this->id)->first()->email;
//    }

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

//    public function rules()
//    {
//        return [
//            'name' => 'required|min:5',
//            'email' => 'required|email',
//        ];
//    }

//    public function validationAttributes()
//    {
//        return [
//            'name' => __('form.full_name'),
//            'email' => __('form.email'),
//        ];
//    }

//    public function save()
//    {
//        $this->validate();
//
//        Auth::user()->contacts()->save(new Contact([
//            'name' => $this->name,
//            'email' => $this->email,
//        ]));
//
//        return Redirect::to(route('contacts.index'));
//    }

//    public function update()
//    {
//        $this->name = $this->currentName;
//        $this->email = $this->currentEmail;
//
//        $this->validate();
//
//        Auth::user()->contacts()->where('id', $this->id)->update([
//            'name' => $this->name,
//            'email' => $this->email,
//        ]);
//
//        return Redirect::to(route('contacts.index'));
//    }

    public function render()
    {
        return view('livewire.projects');
    }
}
