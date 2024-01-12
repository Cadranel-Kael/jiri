<div
    class="bg-white drop-shadow flex flex-col min-w-col-2-sm items-center align-center py-3 px-2 rounded gap-2 place-content-between">
    <div class="basis-1">
        @if($event->status === null)
            <x-more-options
                :items="[
            [
                'label' => __('form.delete'),
                'color' => 'warning',
                'action' => 'delete(' . $event->id . ')',
                'confirm' => __('events.delete'),
            ]
        ]"
            />
        @endif
    </div>
    <x-date-pill :status="$event->status"/>
    <span class="text-center h-12 text-lg text-ellipsis">{{ $event->name }}</span>
    <x-date class="text-black-50" :date="$event->date"/>
    <x-link-outline :href="route('events.show', $event->id)">{{ __('events.see_event') }}</x-link-outline>
</div>
