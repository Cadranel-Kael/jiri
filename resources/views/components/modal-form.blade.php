<div
    x-data="{ show:false }"
    x-show="show"
    x-init="show = (location.hash === '#{{ $name }}')"
    @hashchange.window = "show = (location.hash === '#{{ $name }}')"
    style="display: none"
>
    <a class="fixed block h-screen cursor-default w-screen bg-black opacity-75 top-0 left-0 z-50" aria-hidden="true" href="#"></a>
    <form wire:submit="{{ $submit }}" class="items-stretch fixed z-50 w-fit h-fit absolute bg-white rounded flex flex-col p-4 inset-0 m-auto">
        @csrf
        <div class="flex relative">
            {{ $title }}
            <a href="#" class="absolute right-0">close</a>
        </div>
        <div class="flex flex-col">
            {{ $body }}
        </div>
        <div>
            {{ $footer }}
        </div>
    </form>
</div>
