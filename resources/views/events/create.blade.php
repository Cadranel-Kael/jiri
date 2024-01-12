<x-app-layout :showHeading="false">
    <x-slot name="heading">
        {{ __('events.add_new') }}
    </x-slot>
    <livewire:create-event/>

</x-app-layout>


