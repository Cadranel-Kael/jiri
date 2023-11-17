<div>
    <form action="" class="bg-white drop-shadow">
        <h2 class="sr-only">Generale</h2>
        <x-input label="Nom de l'épreuve" name="name"/>
        <x-date-input label="Date de l'épreuve" name="date"/>
        <h2 class="font-bold">Ajouter les projets</h2>
        {{--                <livewire:list-projects/>--}}
        <div>
            <x-multi-choice
                :sort="$projectSort"
                :order="$projectOrder"
                :sortables="$projectSortables"
            >
                <x-slot:addedList>
                    @foreach($this->addedProjects as $project)
                        <li
                            class="flex items-start ml-4 gap-2 drop-shadow items-center bg-black text-white justify-between py-2 px-4 rounded">
                            <div class="flex items-center gap-2.5">
                                <span class="font-bold">{{ $project->title }}</span>
                                <label class="sr-only" for="weight">Poids</label>
                                <input class="rounded text-black" min="1" value="1" max="100" type="number"
                                       name="weight" id="weight">
                            </div>

                            <button type="button" wire:key="{{ $project->id }}"
                                    wire:click="remove({{$this->addedProjects, $project->id}})">
                                <svg role="img" class="w-9 h-auto stroke-white stroke fill-none" width="33"
                                     height="33">
                                    <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
                                </svg>
                                <span class="sr-only">Add</span>
                            </button>
                        </li>
                    @endforeach
                </x-slot:addedList>
                <x-slot:list>
                    @foreach($this->projects as $project)
                        <li class="flex items-start ml-4 gap-2 drop-shadow items-center bg-white justify-between py-2 px-4 rounded">
                            <span class="font-bold">{{ $project->title }}</span>
                            <button type="button" wire:key="{{ $project->id }}" wire:click="add($this->addedProjects, $project->id)">
                                <svg role="img" class="w-9 h-auto stroke-black stroke fill-none" width="33"
                                     height="33">
                                    <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
                                </svg>
                                <span class="sr-only">Add</span>
                            </button>
                        </li>
                    @endforeach
                </x-slot:list>
            </x-multi-choice>
        </div>
{{--        <x-project-choice :added-projects="$this->addedProjects" :sort="$projectSort" :order="$projectOrder"--}}
{{--                          :sortables="$projectSortables"/>--}}
        <h2>Ajouter les Contacts</h2>
        <livewire:list-contacts/>
    </form>
</div>
