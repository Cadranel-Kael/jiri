<x-app-layout>
    <x-slot name="heading">
        {{ $heading }}
    </x-slot>
    <x-slot name="backUrl">
        {{ route('events.index') }}
    </x-slot>
    <livewire:single-event :id="$id"/>
</x-app-layout>
