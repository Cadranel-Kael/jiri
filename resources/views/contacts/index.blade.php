<x-app-layout>
    <x-slot name="heading">
        {{ __('contacts.title') }}
    </x-slot>
    <label for="sort"></label>
    <select name="sort" id="sort" wire:model.live="sort">
        <option id="name" value="name">Nom</option>
        <option id="email" value="email">Email</option>
        <option id="created" value="created_at">Ajoutée</option>
    </select>
    <livewire:contacts-list/>
</x-app-layout>
