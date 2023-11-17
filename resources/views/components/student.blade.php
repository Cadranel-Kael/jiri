<div class="bg-white justify-between drop-shadow p-4 flex flex-col items-center box-border rounded">
    <div class="flex">
        <img class="rounded-full object-cover w-24 h-24 mb-6" src="{{ $student->image_url }}" alt="" width="106"
             height="106"
             loading="lazy">
        <div class="flex flex-col text-left">
            <div class="text-ellipsis overflow-hidden w-full mb-2">{{ $student->name }}</div>
            <div class="text-black-50 text-ellipsis overflow-hidden w-full mb-6">{{ $student->email }}</div>
        </div>
    </div>
    <div class="w-full">
        @foreach($student->presentations as $presentation)
            <div class="flex items-center bg-black-5 p-2.5 rounded flex-col">
                <div class="flex justify-between">
                    <div>{{ $presentation->project->title }}</div>
{{--                    <div>expand</div>--}}
                </div>
                <div>
                    @foreach($presentation->project->tasks as $task)
                        @php($isMatchingTask = in_array($task, $presentation->tasks))
                        <div class="{{ $isMatchingTask ? 'text-success' : 'text-warning' }}">{{ $task }}</div>
                    @endforeach
{{--                    {{getParticipations($student->id)->tasks}}--}}
{{--                        {{ $this->matchingTasks($student->project->tasks, getParticipations($student->id)->tasks) }}--}}
                </div>
            </div>
        @endforeach
    </div>
    <x-link-outline value="{{ __('contacts.see_profile') }}" href="{{ route('contacts.show', $student->id) }}"/>
</div>


