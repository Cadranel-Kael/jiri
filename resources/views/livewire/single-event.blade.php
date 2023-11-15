<div>
    <div class="flex">
        <div class="flex flex-col items-start ml-4 gap-2">
            <x-date-pill :date="$this->event->date"/>
            <span class="text-h1">{{ $this->event->name }}</span>
            <x-date :date="$this->event->date"/>
            <x-button-primary type="button">Modifier</x-button-primary>
        </div>
    </div>
    <div>
        <h2>Jury</h2>
        <div class="flex">
            @foreach($this->evaluators as $evaluator)
                <x-evaluator :evaluator="$evaluator" />
            @endforeach
        </div>
    </div>
    <div>
        <h2>Students</h2>
        <div class="flex flex-wrap">
            @foreach($this->students as $student)
                <x-student :student="$student" />
            @endforeach
        </div>
    </div>
</div>
