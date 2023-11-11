<div>
    <x-top-bar
        :create-href="route('events.create')"
        :create-label="__('events.create')"
        import-href="#"
        :import-label="__('events.import')"
        sort="sort"
        order="order"
        :options="$this->sortables"
        search="search"
    />
    <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-4 mx-4">
        @foreach($this->events as $event)
            <x-event-card :event="$event"/>
        @endforeach
    </div>
</div>
