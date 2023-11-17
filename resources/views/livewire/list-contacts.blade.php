<div class="rounded drop-shadow bg-white">
    <div class="flex flex-wrap flex-stretch w-full">
        <x-sort :sort="$sort" :order="$order" :options="$sortables"/>
        <x-search class="grow" search="search"/>
    </div>
    <div>
        <div class="flex pt-2 justify-between max-h-36 overflow-y-auto flex-col rounded bg-white gap-2">
            @foreach($this->addedEvaluators as $evaluator)
                <div class="flex items-start ml-4 gap-2 drop-shadow items-center bg-black text-white justify-between py-2 px-4 rounded">
                    <div class="flex items-center gap-2.5">
                        <span class="font-bold">{{ $evaluator->name }}</span>
                        <label class="sr-only" for="weight">Poids</label>
                        <input class="rounded text-black" min="1" value="1" max="100" type="number" name="weight" id="weight">
                    </div>

                    <button type="button" wire:key="{{ $project->id }}" wire:click="removeProject({{$project->id}})">
                        <svg role="img" class="w-9 h-auto stroke-white stroke fill-none" width="33"
                             height="33">
                            <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
                        </svg>
                        <span class="sr-only">Add</span>
                    </button>
                </div>
            @endforeach
            </div>
            <div>
            @foreach($this->contacts() as $contact)
                <div class="flex items-start ml-4 gap-2 drop-shadow items-center bg-white justify-between py-2 px-4 rounded">
                    <span class="font-bold">{{ $contact->name }}</span>
                    <button type="button" wire:key="{{ $contact->id }}" wire:click="addEvaluator({{$contact->id}})">
                        <svg role="img" class="w-9 h-auto stroke-black stroke fill-none" width="33"
                             height="33">
                            <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
                        </svg>
                        <span class="sr-only">Add</span>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>

