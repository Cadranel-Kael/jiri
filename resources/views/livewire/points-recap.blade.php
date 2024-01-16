<div class="overflow-x-scroll w-full" >
    <table class="bg-white rounded drop-shadow m-4">
        <thead class="bg-black-5 text-primary">
        <tr>
            <th>{{ __('events.students') }}</th>
            @foreach($this->evaluators as $evaluator)
                <th colspan="{{ $this->projects()->count() }}" class="border-white border-x-2">{{ $evaluator->name }}</th>
            @endforeach
        </tr>
        <tr>
            <td></td>
            @foreach($this->evaluators as $evaluator)
                @foreach($this->projects() as $project)
                    <th class="rotate-180 border-white border-x-2 border-b-2 p-2" style="writing-mode: vertical-rl" }}>{{ $project->title }}</th>
                @endforeach
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($this->students() as $student)
            <tr>
                <th class="border-black-5 border-y-2 last:border-none">{{ $student->name }}</th>
                @foreach($this->presentations($student->id) as $presentation)
                    @foreach($this->evaluators() as $evaluator)
                        <td class="text-center align-middle border-black-5 border-2 last:border-y-2">@if($this->score($presentation->id, $evaluator->id) !== null)
                                {{ $this->score($presentation->id, $evaluator->id) }}
                            @endif</td>
                    @endforeach
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
