<div>
    @if($this->editMode)
        <form wire:submit="update">
            @endif
            <div class="mb-10">
                <span class="font-bold text-h1">{{ $this->project()->title }}</span>
                @if($this->editMode)
                    <x-button-primary type="submit">{{ __('form.confirm') }}</x-button-primary>
                    <x-button-warning wire:click.prevent="cancel()">{{ __('form.cancel') }}</x-button-warning>
                @else
                    <x-button-primary wire:click.prevent="toggleEditMode">{{ __('projects.edit') }}</x-button-primary>
                @endif
            </div>
            @if($this->editMode)
                <x-input class="max-w-xl" model="form.title" label="{{ __('form.title') }}" name="title"/>
            @endif
            <h2 class="font-bold text-h2">{{ __('projects.description') }}</h2>
            <div class="mb-10">
                @if($this->editMode)
                    <x-text-area class="max-w-xl" model="form.description" label="{{ __('form.description') }}" name="description"/>
                @else
                    {{ $this->project()->description }}
                @endif
            </div>
            <h2 class="font-bold text-h2">{{ __('projects.tasks') }}</h2>
            <div>
                @if($this->editMode)
                    @foreach($this->form->tasks as $key=>$task)
                        <div class="mb-2" wire:key="{{ $key }}">
                            <label class="sr-only" for="task-{{ $key }}">{{ __('form.tasks') }}</label>
                            <input class="rounded border-2 border-black" wire:model="form.tasks.{{ $key }}"
                                   type="text" id="task-{{ $key }}">
                            <button wire:click.prevent="removeTask({{ $key }})">Remove</button>
                        </div>
                    @endforeach
                    <x-button-primary wire:click.prevent="addTask()">Add</x-button-primary>
                @else
                    <ul class="list-disc list-inside">
                        @foreach($this->project()->tasks as $task)
                            <li>{{ $task }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            @if($this->editMode)
        </form>
    @endif
</div>
