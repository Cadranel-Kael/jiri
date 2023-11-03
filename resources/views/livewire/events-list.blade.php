<div>
    <div class="flex flex-col gap-4 mx-4 mb-5">
        <x-link-primary class="w-full" href="#create">{{ __('events.add_new') }}</x-link-primary>
        <x-search search="search"/>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-4 mx-4">
        @foreach($this->events as $event)
            <x-event-card name="{{ $event->name }}" date="{{ $event->date }}"/>
        @endforeach
    </div>
</div>
