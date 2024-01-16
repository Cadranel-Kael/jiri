<x-app-layout showHeading="{{ false }}">
    <x-slot name="heading">
        {{ $heading }}
    </x-slot>
    <livewire:single-event :id="$id"/>
</x-app-layout>
