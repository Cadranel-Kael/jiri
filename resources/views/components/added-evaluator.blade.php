@props([
    /** @var \mixed */
    'evaluator',

    /** @var string */
    'remove'
])
<li
    {{ $attributes->class(['flex items-start mx-4 gap-2 drop-shadow items-center bg-black text-white justify-between py-2 px-4 rounded']) }}>
    <div class="flex items-center gap-3">
        <img class="w-9 h-9 rounded-full" src="{{ $evaluator->image_url }}" alt="photo de {{ $evaluator->name }}">
        <div class="flex flex-col">
            <span>{{ $evaluator->name }}</span>
            <span class="text-black-50 text-sm">{{ $evaluator->email }}</span>
        </div>
    </div>

    <button type="button" wire:key="{{ $evaluator->id }}"
            wire:click="{{ $remove }}">
        <svg role="img" class="w-9 h-auto stroke-white stroke fill-none" width="33"
             height="33">
            <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
        </svg>
        <span class="sr-only">Add</span>
    </button>
</li>


