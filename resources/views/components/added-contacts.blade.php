@props([
    /** @var \mixed */
    'contact',

    /** @var \mixed */
    'addedProjects',

    /** @var string */
    'remove'
])

<li
    {{ $attributes->class(['flex items-start ml-4 gap-2 drop-shadow items-center bg-black text-white justify-between py-2 px-4 rounded']) }}>
    <div class="flex items-center gap-2.5">
        <span class="font-bold">{{ $contact->name }}</span>
        @foreach({{ $addedProjects }})
            <div>
                <span>{{ $addedProjects }}</span>
            </div>
        @endforeach
    </div>

    <button type="button" wire:key="{{ $contact->id }}"
            wire:click="{{ $remove }}">
        <svg role="img" class="w-9 h-auto stroke-white stroke fill-none" width="33"
             height="33">
            <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
        </svg>
        <span class="sr-only">Add</span>
    </button>
</li>

