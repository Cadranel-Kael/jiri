<div class="bg-white justify-between drop-shadow p-4 m-4 flex flex-col items-center box-border rounded">
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
            <div class="flex items-center bg-black-5 p-2.5 rounded flex-col m-4">
                <div class="flex justify-between">
                    <h3>{{ $presentation->project->title }}</h3>
                </div>
                <div>
                    <h4>{{ __('presentations.links') }}</h4>
                    <ul>
                        @foreach($presentation->urls as $index => $url)
                            <li>
                                @if(isset($editingUrls[$presentation['id']]))
                                    <x-input label="url of link" type="text" wire:model="editingUrls.{{ $presentation->id }}.{{ $index }}" />
                                @else
                                    <a href="{{ $url }}" target="_blank">{{ $url }}</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    @dump(isset($editingUrls[$presentation['id']]))
                    @if(isset($editingUrls[$presentation['id']]))
                        <button wire:click="updateUrls({{ $presentation }})">Save</button>
                        <button wire:click="toggleEditUrls({{ $presentation }})">Cancel</button>
                    @else
                        <button wire:click="toggleEditUrls({{ $presentation }})">Edit</button>
                    @endif
                </div>
                <div>
                    <h4>{{ __('tasks') }}</h4>
                    @foreach($presentation->project->tasks as $task)
                        @php($isMatchingTask = in_array($task, $presentation->tasks))
                        <div class="{{ $isMatchingTask ? 'text-success' : 'text-warning' }}">{{ $task }}</div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <x-link-outline value="{{ __('contacts.see_profile') }}" href="{{ route('contacts.show', $student->id) }}"/>
</div>
