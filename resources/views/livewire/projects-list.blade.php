<div>
    <x-modal name="addProjects">
        <x-slot:body>
            <form wire:submit.prevent="add">
                <x-multi-choice
                    change-order="changeOrder()"
                    :sort="$this->sort"
                    :order="$this->order"
                    :sortables="$this->sortables"
                    search="search"
                >
                    @if($this->projects()->isEmpty())
                        <span>{{ __('general.no_results') }}</span>
                        <x-button-primary type="button" x-data
                                          x-on:click="$dispatch('open-modal', { name : 'projectForm' })">{{ __('projects.add_new') }}</x-button-primary>
                    @endif
                    <x-slot:list>
                        @foreach($this->projects() as $project)
                            @if(in_array($project->id, $this->addedProjectsIds))
                                <x-added-projects :weight="false" :project="$project" remove="removeProject({{ $project->id }})"/>
                            @else
                                <x-item-projects :project="$project" add="addProject({{ $project->id }})"/>
                            @endif
                        @endforeach
                    </x-slot:list>
                </x-multi-choice>
                <x-button-primary class="my-4" type="submit">add</x-button-primary>
            </form>
        </x-slot:body>
    </x-modal>
</div>
