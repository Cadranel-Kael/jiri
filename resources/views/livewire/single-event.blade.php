<div>
    <div class="flex mb-6">
        <div class="flex flex-col items-start ml-4 gap-2">
            <x-date-pill :date="$this->event->date"/>
            <span class="text-h1">{{ $this->event->name }}</span>
            <x-date :date="$this->event->date"/>
            <x-button-primary type="button">{{ __('general.edit') }}</x-button-primary>
            <x-button-primary type="button">{{ __('general.start') }}</x-button-primary>
        </div>
    </div>
    <div class="mb-6">
        <div class="ml-4 flex gap-2">
            <h2 class="text-h2 mb-4">{{ __('projects.title') }} ({{ count($this->projects()) }})</h2>
            <button>{{ __('events.project_add') }}</button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-4 mx-4">
            @foreach($this->projects as $project)
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
                <x-evaluator :evaluator="$evaluator" />
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
                <x-student :student="$student" />
            @endforeach
        </div>
    </div>
</div>
