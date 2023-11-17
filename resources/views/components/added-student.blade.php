@props([
    /** @var \mixed */
    'student',

    /** @var \mixed */
    'addedProjects',

    /** @var string */
    'remove'
])
<li
    {{ $attributes->class(['items-start mx-4 gap-2 drop-shadow items-center bg-black text-white py-2 px-4 rounded']) }} wire:key="{{ $student->id }}">
    <div class="flex justify-between">
        <div class="flex items-center gap-3">
            <img class="w-9 h-9 rounded-full" src="{{ $student->image_url }}" alt="photo de {{ $student->name }}">
            <div class="flex flex-col">
                <span>{{ $student->name }}</span>
                <span class="text-black-50 text-sm">{{ $student->email }}</span>
            </div>
        </div>
        <button type="button"
                wire:click="{{ $remove }}">
            <svg role="img" class="w-9 h-auto stroke-white stroke fill-none" width="33"
                 height="33">
                <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
            </svg>
            <span class="sr-only">Add</span>
        </button>
    </div>
    <div class="flex flex-wrap gap-4 items-start text-black">
        @foreach($addedProjects as $project)
            <div x-data="{ expanded:false }" wire:key="{{ $project->id }}" class="bg-white rounded p-2">
                <div class="flex gap-4 justify-between">
                    <button type="button" @click="expanded = true"
                            wire:click="toggleTasks({{$student->id}}, {{$project->id}}, {{ json_encode($project->tasks) }})">
                        <span class="font-bold">{{ $project->title }}</span>
                    </button>
                    <button class="p-2" type="button" @click="expanded =! expanded">
                        <span class="sr-only">expand</span>
                        <svg role="img" class="w-3 h-auto fill-black-50 transition duration-300 ease-out"
                             :class="expanded ? 'rotate-180' : 'rotate-0'" width="12.64"
                             height="6.82">
                            <use xlink:href="{{ asset('icons/icons.svg#chevron') }}"/>
                        </svg>
                    </button>
                </div>
                <ul x-show="expanded" style="display: none">
                    @foreach($project->tasks as $task)
                        <li class="{{ $this->matchTask($student->id, $project->id, $task) ? 'text-success' : 'text-warning'}}">
                            <button
                                class="flex items-center gap-2"
                                type="button"
                                wire:key="{{ $task }}"
                                wire:click="toggleTasks({{$student->id}}, {{$project->id}}, ['{{$task}}'])"
                            >
                                @if($this->matchTask($student->id, $project->id, $task))
                                    <svg role="img" class="w-4 h-auto fill-success" width="16"
                                         height="16">
                                        <use
                                            xlink:href="{{ asset('icons/icons.svg#checked') }}"/>
                                    </svg>
                                @else
                                    <svg role="img" class="w-4 h-auto fill-warning" width="16"
                                         height="16">
                                        <use
                                            xlink:href="{{ asset('icons/icons.svg#crossed') }}"/>
                                    </svg>
                                @endif
                                <span class="sr-only">add</span>
                                {{ $task }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</li>



