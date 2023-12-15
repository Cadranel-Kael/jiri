<x-app-layout>
    <x-slot name="heading">
        {{ $heading }}
    </x-slot>
    <x-slot name="backUrl">{{ route('projects.index') }}</x-slot>
    <livewire:single-project :id="$id"/>
</x-app-layout>
