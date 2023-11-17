@props([
    /** @var \mixed */
    'contact',

    /** @var string */
    'add'
])

<li {{ $attributes->class(['flex items-start mx-4 gap-2 drop-shadow items-center bg-white justify-between py-2 px-4 rounded']) }}>
    <div class="flex items-center gap-3">
        <img class="w-9 h-9 rounded-full" src="{{ $contact->image_url }}" alt="photo de {{ $contact->name }}">
        <div class="flex flex-col">
            <span>{{ $contact->name }}</span>
            <span class="text-black-50 text-sm">{{ $contact->email }}</span>
        </div>
    </div>
    <button type="button" wire:key="{{ $contact->id }}" wire:click="{{ $add }}">
        <svg role="img" class="w-9 h-auto stroke-black stroke fill-none" width="33"
             height="33">
            <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
        </svg>
        <span class="sr-only">Add</span>
    </button>
</li>
