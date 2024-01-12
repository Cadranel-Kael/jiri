<div class="bg-white w-fit rounded p-10 max-w-6xl mx-auto">
    @if($this->event()->status === 'started')
        <button type="button" wire:click.prevent="cancel()">Cancel</button>
    @endif
    @if($this->event()->status == null)
        <livewire:projects-list :event="$this->event()"/>
        <livewire:evaluators-list :event="$this->event()"/>
    @endif
    @if($this->editMode)
        <form wire:submit="update">
            @endif
            <div class="w-fit ml-auto">
                @if($this->event->status === null)
                    @if($this->editMode)
                        <x-button-primary type="submit">{{ __('general.save') }}</x-button-primary>
                        <x-button-warning
                            wire:click.prevent="cancel">{{ __('general.cancel') }}</x-button-warning>
                    @else
                        <div class="flex gap-4">
                            <x-button-primary
                                wire:click.prevent="toggleEditMode()">{{ __('general.edit') }}</x-button-primary>
                            <x-button-primary wire:click="startEvent()"
                                              type="button">{{ __('general.start') }}</x-button-primary>
                        </div>
                    @endif
                @endif
            </div>
            <div class="flex mb-6">
                <div class="flex flex-col items-start ml-4 gap-2">
                    <x-date-pill :status="$this->event->status"/>
                    @if($this->editMode)
                        <x-input name="name" model="form.name" label="Name"/>
                        <x-input name="date" model="form.date" label="Date"/>
                    @else
                        <span class="text-h1">{{ $this->event->name }}</span>
                        <x-date :date="$this->event->date"/>
                    @endif
                </div>
            </div>
            @if($this->editMode)
        </form>
    @endif
    @if($this->event()->status !== null)
        <div>
            <h2>Recap</h2>
            <livewire:points-recap :event="$this->event"/>
        </div>
    @endif
    <div class="mb-6">
        <div class="ml-4 flex items-start gap-2 flex-col mb-4">
            <h2 class="text-h2">{{ __('projects.title') }} ({{ count($this->eventProjects()) }})</h2>
            @if($this->event->status === null)
                <x-button-primary
                    x-on:click="$dispatch('open-modal', { name : 'addProjects' })">{{ __('events.project_add') }}</x-button-primary>
            @endif
        </div>
        <div class="ml-4 mb-8">
            <h3 class="">{{ __('projects.weight_distribution') }}</h3>
            <div class="mb-4 w-full flex max-w-2xl rounded" wire:model.live="projects">
                @foreach($this->projects as $project)
                    @if($weight[$project->id] > 0)
                        <div class="overflow-x-hidden"
                             style="width: {{ $this->weight[$project->id]/array_sum($this->weight)*100 }}%">
                            <div class="font-bold">
                                {{ round($this->weight[$project->id]/array_sum($this->weight)*100) }}%
                            </div>
                            <div class="bg-black rounded mr-2 text-white p-2">{{  $project->title }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-4 mx-4">
            @foreach($this->projects as $project)
                @if($editMode)
                    <x-project-edit weight="weight.{{ $project->id }}" :project="$project"/>
                @else
                    <x-project :project="$project"/>
                @endif
            @endforeach
        </div>
    </div>
    <div class="mb-6">
        <div class="ml-4 flex gap-2">
            <h2 class="text-h2 mb-4">{{ __('events.jury') }} ({{ count($this->evaluators()) }})</h2>
            @if($this->event->status === null)
                <button type="button" wire:click="$dispatch('open-modal', { name : 'addEvaluators' })">{{ __('events.jury_add') }}</button>
            @endif
        </div>
        <div class="flex overflow-x-scroll p-4 gap-4" wire:model.live="evaluators">
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
