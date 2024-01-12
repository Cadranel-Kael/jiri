<div
    class="bg-white drop-shadow flex flex-col min-w-col-2-sm items-center align-center py-3 px-2 rounded gap-2 place-content-between"
>
        <button class="self-end" wire:key="{{ $project->id }}" wire:click="removeProject({{ $project->id }})">
            <svg role="img" class="fill-black w-4 h-auto" width="17.4611" height="19.6782">
                <use xlink:href="{{ asset('icons/icons.svg#icon-close') }}"/>
            </svg>
            <span class="sr-only">remove</span>
        </button>
    <span class="text-center text-ellipsis font-bold">{{ $project->title }}</span>
    <span class="text-center h-12 overflow-hidden text-ellipsis">{{ $project->description }}</span>
    <label for="weight">{{ __('projects.weight') }}</label>
    <input wire:model.live="{{ $weight }}" class="rounded text-black w-20" placeholder="1" type="number"
           name="weight" id="weight" min="0">
</div>
