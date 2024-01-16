<div class="w-full p-10 mx-auto">
    <x-back/>
    @if($this->event()->status === 'started')
        <button type="button" wire:click.prevent="pauseEvent">{{ __('events.pause') }}</button>
    @endif
    @if($this->event()->status === NULL)
        <livewire:projects-list :event="$this->event()"/>
        <livewire:evaluators-list :event="$this->event()"/>
        <livewire:student-list :event="$this->event()" :added-projects="$this->projectIds"/>
    @endif
    @if($this->editMode)
        <form wire:submit="update">
            @endif
            <div class="w-fit ml-auto">
                @if($this->event->status === NULL)
                    @if($this->editMode)
                        <x-button-primary wire:confirm="update">{{ __('general.save') }}</x-button-primary>
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
            <livewire:points-recap :event="$this->event" lazy/>
        </div>
    @endif
    <div class="mb-6 w-full overflow-clip">
        <div class="ml-4 flex items-center gap-2 mb-4">
            <h2 class="text-h2">{{ __('projects.title') }} ({{ count($this->eventProjects()) }})</h2>
            @if($this->event->status === null)
                <button title="{{ __('events.project_add') }}"
                        class="fill-transparent stroke-1 stroke-black hover:fill-black hover:stroke-white"
                        x-on:click="$dispatch('open-modal', { name : 'addProjects' })">
                    <svg height="33" width="33">
                        <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
                    </svg>
                </button>
            @endif
        </div>
        <div class="ml-4 mb-8">
            <h3 class="">{{ __('projects.weight_distribution') }}</h3>
            <div class="mb-4 flex max-w-2xl rounded" wire:model.live="projects">
                @foreach($this->projects as $project)
                    @if($weight[$project->id] > 0)
                        <div class="overflow-x-hidden"
                             style="width: {{ $this->weight[$project->id]/array_sum($this->weight)*100 }}%">
                            <div class="font-bold">
                                {{ round($this->weight[$project->id]/array_sum($this->weight)*100) }}%
                            </div>
                            <div class="bg-black rounded mr-2 text-white p-2">{{ $project->title }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="flex p-2.5 gap-4 overflow-x-auto mx-4">
            @foreach($this->projects as $project)
                @if($editMode)
                    <x-project-edit weight="weight.{{ $project->id }}" :project="$project"/>
                @else
                    <x-project wire:model="project" :project="$project"/>
                @endif
            @endforeach
        </div>
    </div>
    <div class="mb-6 w-full overflow-hidden">
        <div class="ml-4 flex gap-2 items-center">
            <h2 class="text-h2 mb-4">{{ __('events.jury') }} ({{ count($this->evaluators()) }})</h2>
            @if($this->event->status === null)
                <button title="{{ __('events.jury_add') }}"
                        class="fill-transparent stroke-1 stroke-black hover:fill-black hover:stroke-white"
                        x-on:click="$dispatch('open-modal', { name : 'addEvaluators' })">
                    <svg height="33" width="33">
                        <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
                    </svg>
                </button>
            @endif
        </div>
        <div class="flex overflow-x-scroll p-4 gap-4" wire:model.live="evaluators">
            @foreach($this->evaluators as $evaluator)
                <x-evaluator :evaluator="$evaluator"/>
            @endforeach
        </div>
    </div>
    <div class="mx-4 mb-6">
        <div class="ml-4 flex gap-2 items-center">
            <h2 class="text-h2 mb-4">{{ __('events.student') }} ({{ count($this->students()) }})</h2>
            @if($this->event->status === null)
                <button title="{{ __('events.student_add') }}"
                        class="fill-transparent stroke-1 stroke-black hover:fill-black hover:stroke-white"
                        x-on:click="$dispatch('open-modal', { name : 'addStudents' })">
                    <svg height="33" width="33">
                        <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
                    </svg>
                </button>
            @endif
        </div>
        <div class="flex flex-wrap items-start">
            @foreach($this->students as $student)
                <div
                        class="bg-white w-96 justify-start items-start drop-shadow p-4 m-4 flex flex-col box-border rounded">
                    <div class="flex gap-2 items-center">
                        <img class="rounded-full object-cover w-24 h-24 mb-6" src="{{ $student->image_url }}" alt=""
                             width="106"
                             height="106"
                             loading="lazy">
                        <div class="flex flex-col text-left">
                            <h3 class="text-ellipsis overflow-hidden w-full font-bold mb-2">{{ $student->name }}</h3>
                            <div
                                    class="text-black-50 text-ellipsis overflow-hidden w-full mb-6">{{ $student->email }}</div>
                        </div>
                    </div>
                    <div class="w-full">
                        @foreach($student->presentations as $presentation)
                            <div wire:key="{{ $presentation->id }}"
                                 class="flex items-center bg-black-5 p-2.5 rounded flex-col m-4">
                                <div class="flex justify-between">
                                    <h4 class="font-bold">{{ $presentation->project->title }}</h4>
                                </div>
                                <div class="w-full mb-4 border-black-50 border-b" x-data="{ show: false }">
                                    <div class="flex justify-between">
                                        <h5 class="font-bold">{{ __('general.links') }}</h5>
                                        <button x-on:click="show = ! show">expand</button>
                                    </div>
                                    <ul x-show="show" class="list-disc list-inside" x-transition
                                        style="display: none">
                                        @isset($presentation->urls)
                                            @foreach($presentation->urls as $index => $url)
                                                <li wire:key="{{ $presentation->id . $index }}">
                                                    @if(isset($editingUrls[$presentation['id']]))
                                                        <x-input label-sr-only="true" label="link {{ $index + 1 }}"
                                                                 name="editingUrls.{{ $presentation->id }}.{{ $index }}"
                                                                 type="text"
                                                                 wire:model="editingUrls.{{ $presentation->id }}.{{ $index }}"/>
                                                    @else
                                                        <a class="text-primary" href="{{ $url }}"
                                                           target="_blank">{{ $url }}</a>
                                                    @endif
                                                </li>
                                            @endforeach
                                    </ul>
                                    @endisset
                                </div>
                                {{--                                <div class="w-full">--}}
                                {{--                                    @if(isset($editingUrls[$presentation['id']]))--}}
                                {{--                                        <button wire:click="updateUrls({{ $presentation->id }})">Save</button>--}}
                                {{--                                        <button wire:click.prevent="toggleEditUrls({{ $presentation->id }})">Cancel--}}
                                {{--                                        </button>--}}
                                {{--                                    @else--}}
                                {{--                                        <button wire:click.prevent="toggleEditUrls({{ $presentation->id }})">Edit--}}
                                {{--                                        </button>--}}
                                {{--                                    @endif--}}
                                {{--                                </div>--}}
                                <div class="border-black-50 border-b w-full" x-data="{ show: false }">
                                    <div class="flex justify-between">
                                        <h5 class="font-bold">{{ __('projects.tasks') }}</h5>
                                        <button type="button" x-on:click.prevent="show = ! show">expand</button>
                                    </div>
                                    <div x-show="show" class="ml-1">
                                        @isset($presentation->tasks)
                                            @foreach($presentation->project->tasks as $task)
                                                @php($isMatchingTask = in_array($task, $presentation->tasks))
                                                <div
                                                        class="{{ $isMatchingTask ? 'text-success' : 'text-warning' }}">{{ $task }}</div>
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <x-link-outline class="self-center"
                                    href="{{ route('contacts.show', $student->id) }}">{{ __('contacts.see_profile') }}</x-link-outline>
                </div>
            @endforeach
        </div>
    </div>
</div>
