@props([
    /** @var \mixed */
    'project',

    /** @var string */
    'remove'
])

<li
        {{ $attributes->class(['flex items-start mx-4 gap-2 drop-shadow items-center bg-black text-white justify-between py-2 px-4 rounded']) }}>
    <div class="flex items-center gap-2.5">
        <span class="font-bold">{{ $project->title }}</span>
        <label class="sr-only" for="weight">Poids</label>
        <input class="rounded text-black" min="1" value="1" max="100" type="number"
               name="weight" id="weight">
    </div>

    <button type="button" wire:key="{{ $project->id }}"
            wire:click="{{ $remove }}">
        <svg role="img" class="w-9 h-auto stroke-white stroke fill-none" width="33"
             height="33">
            <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
        </svg>
        <span class="sr-only">Add</span>
    </button>
</li>
