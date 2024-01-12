<div class="overflow-x-hidden">
    <table class="overflow-x-scroll">
        <thead>
        <tr>
            <th>Students</th>
            @foreach($this->evaluators as $evaluator)
                <th colspan="{{ $this->projects()->count() }}">{{ $evaluator->name }}</th>
            @endforeach
        </tr>
        <tr>
            <td></td>
            @foreach($this->evaluators as $evaluator)
                @foreach($this->projects() as $project)
                    <th>{{ $project->title }}</th>
                @endforeach
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($this->students() as $student)
            <tr>
                <th>{{ $student->name }}</th>
                @foreach($this->presentations($student->id) as $presentation)
                    @foreach($this->evaluators() as $evaluator)
                        <td>@if($this->score($presentation->id, $evaluator->id) !== null)
                                {{ $this->score($presentation->id, $evaluator->id) }}
                            @endif</td>
                    @endforeach
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
