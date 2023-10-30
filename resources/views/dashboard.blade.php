<x-app-layout>
    <x-slot name="heading">
        {{ 'Dashboard' }}
    </x-slot>
    <h2 class="font-bold lg:text-h2 text-h2-sm px-4 mb-2 lg:mb-5">Épreuves à venir</h2>
    <livewire:future-events class="items-stretch flex gap-5 overflow-x-auto px-4 pb-4 mb-4 lg:mb-20"/>
    <h2 class="font-bold lg:text-h2 text-h2-sm mx-4 mb-2 lg:mb-5">Résultats des dernières années</h2>
    <h2 class="font-bold lg:text-h2 text-h2-sm mx-4 mb-2 lg:mb-5">Épreuves</h2>
    <livewire:events-stats class="bg-white rounded mx-4 p-4"/>
</x-app-layout>
