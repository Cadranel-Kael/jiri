<x-app-layout>
    <x-slot name="heading">
        {{ __('events.add_new') }}
    </x-slot>
    <form action="">
        <h2 class="sr-only">Generale</h2>
        <x-input label="Nom de l'épreuve" name="name"/>
        <x-date />
        <h2>Ajouter les membres</h2>
        <livewire:list-multichoice/>
        <h2>Ajouter les projets</h2>
    </form>
</x-app-layout>
