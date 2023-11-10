<div
    class="bg-white drop-shadow flex flex-col min-w-col-2-sm items-center align-center py-3 px-2 rounded gap-2 place-content-between">
    <x-date-pill :date="$date"/>
    <span class="text-center h-12 text-lg text-ellipsis">{{ $name }}</span>
    <x-date class="text-black-50" :date="$date" />
    <x-link-outline :href="route('events.show', $id)" value="Voire l'épreuve"/>
</div>
