<div x-data="{ show:false }"
     x-show="show"
     x-init="show = (location.hash === '#{{ $name }}')"
     @hashchange.window = "show = (location.hash === '#{{ $name }}')"
    style="display: none"
     wire:keydown.escape="show = false"
>
    <a class="fixed block h-screen cursor-default w-screen bg-black opacity-75 top-0 left-0 z-50" aria-hidden="true" href="#"></a>
    <form wire:submit="{{ $submit }}" class="items-stretch fixed min-w-col-8 z-50 w-fit h-fit absolute bg-white rounded flex flex-col py-12 px-20 inset-0 m-auto">
        <div class="flex relative">
            {{ $title }}
            <a href="#" class="absolute right-0">
                <svg role="img" class="fill-black w-4 h-auto" width="17.4611" height="19.6782">
                    <use xlink:href="{{ asset('icons/icons.svg#icon-close') }}"/>
                </svg>
                <span class="sr-only">
                    close
                </span>
            </a>
        </div>
        <div class="flex flex-col gap-9">
            {{ $body }}
        </div>
        <div>
            {{ $footer }}
        </div>
    </form>
</div>
