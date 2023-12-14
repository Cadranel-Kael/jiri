<div>
    <x-modal name="projectForm">
        <x-slot:title>
            <h2 class="font-bold text-h3 text-center m-auto">
                {{ __('projects.add_new') }}
            </h2>
        </x-slot:title>
        <x-slot:body>
            <form wire:submit.prevent="saveProject">
                <x-input class="mb-10" label="{{ __('projects.name') }}" name="title" model="createProjectForm.title"/>
                <x-input class="mb-10" label="{{ __('projects.description') }}" name="description" model="createProjectForm.description"/>
                <x-button-primary class="mt-2 mx-auto" type="submit">{{ __('projects.add_new') }}</x-button-primary>
            </form>
        </x-slot:body>
    </x-modal>
    <x-modal name="evaluatorForm">
        <x-slot:title>
            <h2 class="font-bold text-h3 text-center m-auto">
                {{ __('events.jury_add') }}
            </h2>
        </x-slot:title>
        <x-slot:body>
            <form wire:submit.prevent="saveEvaluator">
                <x-input class="mb-10" label="{{ __('form.name') }}" name="name" model="createEvaluatorForm.name"/>
                <x-input class="mb-10" label="{{ __('form.email') }}" name="email" model="createEvaluatorForm.email"/>
                <x-button-primary class="mt-2 mx-auto" type="submit">{{ __('contacts.add_new') }}</x-button-primary>
            </form>
        </x-slot:body>
    </x-modal>
    <x-modal name="studentForm">
        <x-slot:title>
            <h2 class="font-bold text-h3 text-center m-auto">
                {{ __('events.student_add') }}
            </h2>
        </x-slot:title>
        <x-slot:body>
            <form wire:submit.prevent="saveStudent">
                <x-input class="mb-10" label="{{ __('form.name') }}" name="name" model="createStudentForm.name"/>
                <x-input class="mb-10" label="{{ __('form.email') }}" name="email" model="createStudentForm.email"/>
                <x-button-primary class="mt-2 mx-auto" type="submit">{{ __('contacts.add_new') }}</x-button-primary>
            </form>
        </x-slot:body>
    </x-modal>
    <form wire:submit.prevent="save" class="bg-white drop-shadow flex flex-col lg:p-8 rounded w-fit m-auto">
        <div class="grid grid-cols-2 mb-10">
            <div class="w-fit flex flex-col gap-8">
                <h2 class="sr-only">Generale</h2>
                <x-input label="Nom de l'épreuve" name="name" model="eventForm.name"/>
                <x-date-input label="Date de l'épreuve" name="date" model="eventForm.date"/>
            </div>
            <div class="my-20 lg:my-0">
                <h2 class="font-bold lg:mb-8">Ajouter les projets</h2>
                <div class="ml-4 w-5/6">
                    <h3 class="font-bold mb-2">Projets</h3>
                    @if(array_sum($this->weight))
                    <h4>{{ __('projects.weight_distribution') }}</h4>
                    <div class="flex w-full mb-2">
                            @foreach($this->addedProjects() as $project)
                                @if($this->weight[$project->id])
                                    <div
                                        style="width: {{ ($this->weight[$project->id]/array_sum($this->weight))*100 }}%">
                                        <div>{{ round($this->weight[$project->id]/array_sum($this->weight)*100) }}%
                                        </div>
                                        <div class="bg-black mr-2 text-white p-2 rounded">{{  $project->title }}</div>
                                    </div>
                                @endif
                            @endforeach
                    </div>
                    @endif
                    <x-multi-choice
                        change-order="changeOrder('projects')"
                        :sort="$projectSort"
                        :order="$projectOrder"
                        :sortables="$projectSortables"
                        search="projectSearch"
                    >
                        @if($this->projects()->isEmpty())
                            <span>{{ __('general.no_results') }}</span>
                            <x-button-primary type="button" x-data x-on:click="$dispatch('open-modal', { name : 'projectForm' })">{{ __('projects.add_new') }}</x-button-primary>
                        @endif
                        <x-slot:addedList>
                            @foreach($this->addedProjects() as $project)
                                <x-added-projects :project="$project" remove="remove('projects', {{ $project->id }})"/>
                            @endforeach
                        </x-slot:addedList>
                        <x-slot:list>
                            @foreach($this->projects as $project)
                                <x-item-projects :project="$project" add="add('projects', {{ $project->id }})"/>
                            @endforeach
                        </x-slot:list>
                    </x-multi-choice>
                </div>
            </div>
        </div>
        <div class="lg:grid lg:grid-cols-2">
            <h2 class="col-span-2 font-bold lg:mb-8">Ajouter les Contacts</h2>
            <div class="ml-4 w-5/6">
                <h3 class="font-bold mb-2">Jury</h3>
                <x-multi-choice
                    change-order="changeOrder('contacts')"
                    :sort="$evaluatorSort"
                    :order="$evaluatorOrder"
                    :sortables="$evaluatorSortables"
                    search="evaluatorSearch"
                >
                    @if($this->evaluators()->isEmpty())
                        <span>{{ __('general.no_results') }}</span>
                        <x-button-primary type="button" x-data x-on:click="$dispatch('open-modal', { name : 'evaluatorForm' })">{{ __('contacts.add_new') }}</x-button-primary>
                    @endif
                    <x-slot:addedList>
                        @foreach($this->addedEvaluators as $evaluator)
                            <x-added-evaluator :evaluator="$evaluator"
                                               remove="remove('evaluators', {{ $evaluator->id }})"/>
                        @endforeach
                    </x-slot:addedList>
                    <x-slot:list>
                        @foreach($this->evaluators as $evaluator)
                            <x-item-contacts :contact="$evaluator" add="add('evaluators', {{ $evaluator->id }})"/>
                        @endforeach
                    </x-slot:list>
                </x-multi-choice>
            </div>
            <div class="ml-2 w-5/6">
                <h3 class="font-bold mb-2">Etudiant</h3>
                <x-multi-choice
                    change-order="changeOrder('contacts')"
                    :sort="$studentSort"
                    :order="$studentOrder"
                    :sortables="$studentSortables"
                    search="studentSearch"
                >
                    @if($this->students()->isEmpty())
                        <span>{{ __('general.no_results') }}</span>
                        <x-button-primary type="button" x-data x-on:click="$dispatch('open-modal', { name : 'studentForm' })">{{ __('contacts.add_new') }}</x-button-primary>
                    @endif
                    <x-slot:addedList>
                        @foreach($this->addedStudents as $student)
                            <x-added-student :addedProjects="$this->addedProjects()" :student="$student"
                                             remove="remove('students', {{ $student->id }})"/>
                        @endforeach
                    </x-slot:addedList>
                    <x-slot:list>
                        @foreach($this->students as $student)
                            <x-item-contacts :contact="$student" add="add('students', {{ $student->id }})"/>
                        @endforeach
                    </x-slot:list>
                </x-multi-choice>
            </div>
        </div>
        <x-button-primary class="w-fit m-auto mt-10" type="submit">Crée une épreuve</x-button-primary>
    </form>
</div>
