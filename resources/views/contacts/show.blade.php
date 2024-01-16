<x-app-layout showHeading="{{ false }}">
    <x-slot name="heading">
        {{ $heading }}
    </x-slot>
    <x-slot name="backUrl">{{ route('contacts.index') }}</x-slot>
    <livewire:single-contact :id="$id"/>
</x-app-layout>
