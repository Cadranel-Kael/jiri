<a title="{{ $name }}" href="{{ $href }}" class="rounded flex items-center group hover:bg-white {{ $active ? 'bg-white' : 'hover:bg-white' }}">
    <div class="group rounded p-2 {{ $active ? 'bg-white' : 'group-hover:bg-white' }} h-10 w-10 flex">
        <svg role="img"
             class="w-6 h-auto fill-white {{ $active ? 'fill-primary' : 'group-hover:fill-primary'}}" width="{{ $width }}"
             height="{{ $height }}">
            <use xlink:href="{{ asset('icons/icons.svg#' . $icon) }}"/>
        </svg>
    </div>
    <span
        x-show="expanded"
        x-transition
        style="display: none"
        class="ml-6 {{ $active ? 'text-primary' : 'group-hover:text-primary' }}">{{ $name }}</span>
</a>
