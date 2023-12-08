@props([
    'name',
    'title',
    'confirm' => __('form.confirm'),
    'cancel' => __('form.cancel'),
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
        </div>
        <div class="flex flex-col">
            <x-button-warning x-on:click="{{ $action }}">{{ $confirm }}</x-button-warning>
            <x-button-white x-on:wire:click="show = false">{{ $cancel }}</x-button-white>
        </div>
    </div>
</div>
