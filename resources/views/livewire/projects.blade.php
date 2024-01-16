<div>
    <x-modal-form submit="save" name="create">
        <x-slot:title>
            <h3 class="text-h3 font-bold mb-12">{{ __('projects.add_new') }}</h3>
        </x-slot:title>
        <x-slot:body>
            <x-input required="true" label="{{ __('form.title') }}" name="title" model="createProjectForm.title"/>
            <x-text-area required="true" label="{{ __('form.description') }}" name="description"
                         model="createProjectForm.description"/>
            <x-input label="{{ __('project.link') }}" name="link" model="createProjectForm.link"
                     placeholder="https://github.com/"/>
            <div class="border-black border-b-2 mb-12 py-2">
                <h4 class="font-bold">{{ __('form.tasks') }}</h4>
                @isset($this->createProjectForm->tasks)
                    @foreach($this->createProjectForm->tasks as $key=>$task)
                        <div class="mb-2" wire:key="{{ $key }}">
                            <label class="sr-only" for="task-{{ $key }}">{{ __('form.tasks') }}</label>
                            <input class="rounded border-2 border-black" wire:model="createProjectForm.tasks.{{ $key }}"
                                   type="text" id="task-{{ $key }}">
                            <button wire:click.prevent="removeTask({{ $key }})">Remove</button>
                        </div>
                    @endforeach
                @endisset
                <x-button-primary wire:click.prevent="addTask">Add</x-button-primary>
            </div>
        </x-slot:body>
        <x-slot:footer>
            <x-button-primary type="submit">{{ __('projects.add_new') }}</x-button-primary>
        </x-slot:footer>
    </x-modal-form>
    <x-top-bar
        createHref="#create"
        :createLabel="__('projects.add_new')"
        importHref="#import"
        :importLabel="__('projects.import')"
        sort="sort"
        :order="$this->order"
        :options="$this->sortables"
        search="search"
    />
    <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-4 mx-4">
        @foreach($this->projects as $project)
            <x-project-card :project="$project"/>
        @endforeach
    </div>
    @if($this->projects()->isEmpty())
        <div class="text-center mt-24">
            @if(!$this->hasProjects())
                <div class="max-w-6 mx-auto">{{ __('projects.no_projects') }}</div>
            @else
                <div>{{ __('form.no_results_for') }} <span class="font-bold">{{ $this->search }}</span>
                </div>
            @endif
            <x-link-primary class="mt-2 w-fit mx-auto" href="#create">{{ __('projects.add_new') }}</x-link-primary>
        </div>
    @else
        <div class="flex justify-center p-10">
            <x-primary-button type="button" wire:click="loadMore">Load more</x-primary-button>
        </div>
    @endif
</div>

