@props([
    'name',
    'title' => null,
    'footer' => null,
])

<div
    x-data="{ show: false, name: '{{ $name }}' }"
    x-show="show"
    x-on:open-modal.window="show = ($event.detail.name === name)"
    x-on:close-modal.window="show = ($event.detail.name === name)"
    x-on:keydown.escape.window="show = false"
    x-on:form-submitted.window="show = false"
    class="fixed inset-0 z-50 flex items-center justify-center"
    style="display: none;"
>
    <button x-data x-on:click="show = false" class="fixed block h-screen cursor-default w-screen bg-black opacity-75 top-0 left-0 z-50" aria-hidden="true"></button>
    <div class="items-stretch top-0 px-8 py-6 z-50 w-fit h-fit absolute bg-white rounded flex flex-col p-4 inset-0 m-auto">
        <div class="flex relative items-center mb-12">
            {{ $title }}
            <button x-data x-on:click="show = false" type="button" class="absolute right-0">
                <svg role="img" class="fill-black w-4 h-auto" width="17.4611" height="19.6782">
                    <use xlink:href="{{ asset('icons/icons.svg#icon-close') }}"/>
                </svg>
                <span class="sr-only">
                    close
                </span>
            </button>
        </div>
        <div class="flex flex-col">
            {{ $body }}
        </div>
        <div>
            {{ $footer }}
        </div>
    </div>
</div>
