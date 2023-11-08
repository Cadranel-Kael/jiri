<x-app-layout>
    <x-slot name="heading">
        {{ $heading }}
    </x-slot>
    <livewire:single-contact :id="$id"/>
</x-app-layout>
