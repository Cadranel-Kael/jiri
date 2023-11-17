<div>
    <form wire:submit="save" class="bg-white drop-shadow flex flex-col lg:p-8 rounded w-fit m-auto">
        <div class="grid grid-cols-2 mb-10">
            <div class="w-fit flex flex-col gap-8">
                <h2 class="sr-only">Generale</h2>
                <x-input label="Nom de l'épreuve" name="name"/>
                <x-date-input label="Date de l'épreuve" name="date"/>
            </div>
            <div class="my-20 lg:my-0">
                <h2 class="font-bold lg:mb-8">Ajouter les projets</h2>
                <div class="ml-4 w-5/6">
                    <h3 class="font-bold mb-2">Projets</h3>
                    <x-multi-choice
                        change-order="changeOrder('projects')"
                        :sort="$projectSort"
                        :order="$projectOrder"
                        :sortables="$projectSortables"
                        search="projectSearch"
                    >
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
        <div class="grid grid-cols-2">
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
                    <x-slot:addedList>
                        @foreach($this->addedEvaluators as $evaluator)
                            <x-added-evaluator :evaluator="$evaluator" remove="remove('evaluators', {{ $evaluator->id }})"/>
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
