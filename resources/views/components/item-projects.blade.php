@props([
    /** @var \mixed */
    'project',

    /** @var string */
    'add'
])

<li {{ $attributes->class(['flex items-start mx-4 gap-2 drop-shadow items-center bg-white justify-between py-2 px-4 rounded']) }}>
    <div class="flex-col flex">
    <span class="font-bold">{{ $project->title }}</span>
    <span class="text-black-50 text-sm">{{ \Carbon\Carbon::parse($project->created_at)->calendar() }}</span>
    </div>
    <button type="button" wire:key="{{ $project->id }}" wire:click="{{ $add }}">
        <svg role="img" class="w-9 h-auto stroke-black stroke fill-none" width="33"
             height="33">
            <use xlink:href="{{ asset('icons/icons.svg#plus') }}"/>
        </svg>
        <span class="sr-only">Add</span>
    </button>
</li>
