<x-app-layout>
    <x-slot name="heading">
        {{ 'Dashboard' }}
    </x-slot>
    @if($current_event)
        <h2 class="font-bold lg:text-h2 text-h2-sm px-4 mb-2 lg:mb-5">Recap des points</h2>
        <livewire:points-recap :event="$current_event"/>
    @else
        <h2 class="font-bold lg:text-h2 text-h2-sm px-4 mb-2 lg:mb-5">{{ __('dashboard.future_events') }}</h2>
        @if($events->count() > 0)
            <div class="flex flex-row gap-4 p-4 overflow-scroll mb-10">
                @foreach($events as $event)
                    <x-event-card :event="$event"
                                  class="items-stretch flex gap-5 overflow-x-auto px-4 pb-4 mb-4 lg:mb-20"/>
                @endforeach
            </div>
        @else
            <div class="w-fit ml-4 mb-8">
                <div class="mx-auto">{{ __('dashboard.no_future_events') }}</div>
                <x-link-primary class="mt-2 w-fit mx-auto" href="{{ route('events.create') }}">{{ __('events.create') }}</x-link-primary>
            </div>
        @endif
        <div class="flex flex-col lg:flex-row lg:mr-32 gap-4">
            <div class="flex-1 w-fit">
                <h2 class="font-bold lg:text-h2 text-h2-sm mx-4 mb-2 lg:mb-5">{{ __('dashboard.past_results') }}</h2>
                <livewire:past-results-chart/>
            </div>
            <div class="flex-1">
                <h2 class="font-bold lg:text-h2 text-h2-sm mx-4 mb-2 lg:mb-5">{{ __('form.events') }}</h2>
                <livewire:events-stats class="drop-shadow bg-white rounded mx-4 p-4"/>
            </div>
        </div>
    @endif

</x-app-layout>
