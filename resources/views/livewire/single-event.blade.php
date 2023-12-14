<div>
    <x-modal name="addProjects">
        <x-slot:body>
            <form wire:submit.prevent="addProjects">
                <x-multi-choice
                    change-order="changeProjectOrder()"
                    :sort="$projectSort"
                    :order="$projectOrder"
                    :sortables="$projectSortables"
                    search="projectSearch"
                >
                    @if($this->projects()->isEmpty())
                        <span>{{ __('general.no_results') }}</span>
                        <x-button-primary type="button" x-data
                                          x-on:click="$dispatch('open-modal', { name : 'projectForm' })">{{ __('projects.add_new') }}</x-button-primary>
                    @endif
                    <x-slot:addedList>
                        @foreach($this->addedProjects() as $project)
                            <x-added-projects :project="$project" remove="removeProjectId({{ $project->id }})"/>
                        @endforeach
                    </x-slot:addedList>
                    <x-slot:list>
                        @foreach($this->projects as $project)
                            <x-item-projects :project="$project" add="addProjectId({{ $project->id }})"/>
                        @endforeach
                    </x-slot:list>
                </x-multi-choice>
                <x-button-primary class="my-4" type="submit">add</x-button-primary>
            </form>
        </x-slot:body>
    </x-modal>
    <div class="flex mb-6">
        <div class="flex flex-col items-start ml-4 gap-2">
            <x-date-pill :status="$this->event->status"/>
            <span class="text-h1">{{ $this->event->name }}</span>
            <x-date :date="$this->event->date"/>
            <x-button-primary type="button">{{ __('general.edit') }}</x-button-primary>
            <x-button-primary type="button">{{ __('general.start') }}</x-button-primary>
        </div>
    </div>
    <div class="mb-6">
        <div class="ml-4 flex items-center gap-2">
            <h2 class="text-h2 mb-4">{{ __('projects.title') }} ({{ count($this->eventProjects()) }})</h2>
            <x-button-primary
                x-on:click="$dispatch('open-modal', { name : 'addProjects' })">{{ __('events.project_add') }}</x-button-primary>
        </div>
        <div class="ml-4">
            <h3 class="">{{ __('projects.weight_distribution') }}</h3>
            <div class="mb-8 w-full flex max-w-2xl">
                @foreach($this->eventProjects() as $project)
                    @if($project->pivot->weight > 0)
                        <div
                            style="width: {{ ($project->pivot->weight/$this->event->projects()->sum('weight'))*100 }}%">
                            <div>{{ round($project->pivot->weight/$this->event->projects()->sum('weight')*100) }}%</div>
                            <div class="bg-black mr-2 text-white p-2 rounded">{{  $project->title }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-4 mx-4">
            @foreach($this->eventProjects() as $project)
                <x-project :project="$project"></x-project>
            @endforeach
        </div>
    </div>
    <div class="mb-6">
        <div class="ml-4 flex gap-2">
            <h2 class="text-h2 mb-4">{{ __('events.jury') }} ({{ count($this->evaluators()) }})</h2>
            <button type="button" wire:click="openEvaluatorModal">{{ __('events.jury_add') }}</button>
        </div>
        <div class="flex overflow-x-scroll p-4 gap-4">
            @foreach($this->evaluators as $evaluator)
                <x-evaluator :evaluator="$evaluator"/>
            @endforeach
        </div>
    </div>
    <div class="mx-4 mb-6">
        <div class="ml-4 flex gap-2">
            <h2 class="text-h2 mb-4">{{ __('events.student') }} ({{ count($this->students()) }})</h2>
            <button type="button" wire:click="openEvaluatorModal">{{ __('events.student_add') }}</button>
        </div>
        <div class="flex flex-wrap">
            @foreach($this->students as $student)
                <div class="bg-white justify-between drop-shadow p-4 m-4 flex flex-col items-center box-border rounded">
                    <div class="flex">
                        <img class="rounded-full object-cover w-24 h-24 mb-6" src="{{ $student->image_url }}" alt=""
                             width="106"
                             height="106"
                             loading="lazy">
                        <div class="flex flex-col text-left">
                            <div class="text-ellipsis overflow-hidden w-full mb-2">{{ $student->name }}</div>
                            <div
                                class="text-black-50 text-ellipsis overflow-hidden w-full mb-6">{{ $student->email }}</div>
                        </div>
                    </div>
                    <div class="w-full">
                        @foreach($student->presentations as $presentation)
                            <div wire:key="{{ $presentation->id }}"
                                 class="flex items-center bg-black-5 p-2.5 rounded flex-col m-4">
                                <div class="flex justify-between">
                                    <h3>{{ $presentation->project->title }}</h3>
                                </div>
                                <div>
                                    <h4>{{ __('presentations.links') }}</h4>
                                    <ul>
                                        @isset($presentation->urls)
                                            @foreach($presentation->urls as $index => $url)
                                                <li wire:key="{{ $presentation->id . $index }}">
                                                    @if(isset($editingUrls[$presentation['id']]))
                                                        <x-input label-sr-only="true" label="link {{ $index + 1 }}"
                                                                 name="editingUrls.{{ $presentation->id }}.{{ $index }}"
                                                                 type="text"
                                                                 wire:model="editingUrls.{{ $presentation->id }}.{{ $index }}"/>
                                                    @else
                                                        <a href="{{ $url }}" target="_blank">{{ $url }}</a>
                                                    @endif
                                                </li>
                                            @endforeach
                                    </ul>
                                    @endisset
                                    @if(isset($editingUrls[$presentation['id']]))
                                        <button wire:click="updateUrls({{ $presentation->id }})">Save</button>
                                        <button wire:click.prevent="toggleEditUrls({{ $presentation->id }})">Cancel
                                        </button>
                                    @else
                                        <button wire:click.prevent="toggleEditUrls({{ $presentation->id }})">Edit
                                        </button>
                                    @endif
                                </div>
                                <div>
                                    <h4>{{ __('tasks') }}</h4>
                                    @isset($presentation->tasks)
                                        @foreach($presentation->project->tasks as $task)
                                            @php($isMatchingTask = in_array($task, $presentation->tasks))
                                            <div
                                                class="{{ $isMatchingTask ? 'text-success' : 'text-warning' }}">{{ $task }}</div>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <x-link-outline value="{{ __('contacts.see_profile') }}"
                                    href="{{ route('contacts.show', $student->id) }}"/>
                </div>
            @endforeach
        </div>
    </div>
</div>
