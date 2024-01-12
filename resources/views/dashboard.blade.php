<x-app-layout>
    <x-slot name="heading">
        {{ 'Dashboard' }}
    </x-slot>
    @if($current_event)
        <h2 class="font-bold lg:text-h2 text-h2-sm px-4 mb-2 lg:mb-5">Recap des points</h2>
        <livewire:points-recap :event="$current_event"/>
    @else
    <h2 class="font-bold lg:text-h2 text-h2-sm px-4 mb-2 lg:mb-5">Épreuves à venir</h2>
    <div class="flex flex-row gap-4 p-4 overflow-scroll mb-10">
        @foreach($events as $event)
            <x-event-card :event="$event"
                          class="items-stretch flex gap-5 overflow-x-auto px-4 pb-4 mb-4 lg:mb-20"/>
        @endforeach
    </div>
    <div class="flex flex-col lg:flex-row lg:mr-32">
        <div class="flex-1">
        <h2 class="font-bold lg:text-h2 text-h2-sm mx-4 mb-2 lg:mb-5">Résultats des dernières années</h2>
        </div>
        <div class="flex-1">
            <h2 class="font-bold lg:text-h2 text-h2-sm mx-4 mb-2 lg:mb-5">Épreuves</h2>
            <livewire:events-stats class="bg-white rounded mx-4 p-4"/>
        </div>
    </div>
    @endif

</x-app-layout>
