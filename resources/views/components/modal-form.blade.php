@props(['name'])
<div
    x-data="{ show:false }"
    x-show="show"
    x-init="show = (location.hash === '#{{ $name }}')"
    @hashchange.window = "show = (location.hash === '#{{ $name }}')"
    @open-modal.window="($event.detail.name === {{ $name }}) ? (show = true, location.hash = '#{{ $name }}') : '';"
>
    <a class="fixed block h-screen cursor-default w-screen bg-black opacity-75 top-0 left-0 z-10" href="#"></a>
    <form action="{{ $action ?? '' }}" method="{{ $method ?? '' }}" class="fixed z-20 w-fit h-fit absolute bg-white rounded flex flex-col p-4 inset-0 m-auto">
        @csrf
        <div class="flex justify-between">
            {{ $title }}
            <a href="#">close</a>
        </div>
        <div class="flex flex-col">
            {{ $body }}
        </div>
        <div>
            {{ $footer }}
        </div>
    </form>
</div>
