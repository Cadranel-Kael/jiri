<div class="{{ $class }}">
    @foreach($this->events as $event)
        <x-event-2-col name="{{ $event->name }}" date="{{ $event->date->toFormattedDateString() }}"/>
    @endforeach
</div>
