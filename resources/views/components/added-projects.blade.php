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
        <label for="weight">{{ __('projects.weight') }}</label>
        <input wire:model.live="weight.{{ $project->id }}" class="rounded text-black w-20" placeholder="1" type="number"
               name="weight" id="weight">
    </div>

    <button type="button" wire:key="{{ $project->id }}"
            wire:click="{{ $remove }}">
        <svg
            role="img"
            class="w-4 h-auto fill-white stroke-none"
            width="33"
            height="33">
            <use xlink:href="{{ asset('icons/icons.svg#icon-close') }}"/>
        </svg>
        <span class="sr-only">Add</span>
    </button>
</li>
