<a wire:navigate title="{{ $name }}" href="{{ $href }}" class="rounded flex items-center group hover:bg-white transition duration-150 ease-out {{ $active ? 'bg-white' : 'hover:bg-white' }}">
    <div class="group rounded p-2 transition duration-150 ease-out {{ $active ? 'bg-white' : 'group-hover:bg-white' }} h-10 w-10 flex">
        <svg role="img"
             class="w-6 h-auto transition duration-150 ease-out {{ $active ? 'fill-primary' : 'group-hover:fill-primary fill-white'}}" width="{{ $width }}"
             height="{{ $height }}">
            <use xlink:href="{{ asset('icons/icons.svg#' . $icon) }}"/>
        </svg>
    </div>
    <span
        x-show="expanded"
        x-transition
        style="display: none"
        class="ml-6 transition duration-150 ease-out {{ $active ? 'text-primary' : 'group-hover:text-primary' }}">{{ $name }}</span>
</a>
