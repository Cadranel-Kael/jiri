<div class="rounded drop-shadow bg-white p-2">
    <div class="flex flex-wrap flex-stretch w-full">
        <x-sort class="mr-3 mb-2" :change-order="$changeOrder" :sort="$sort" :order="$order" :options="$sortables"/>
        <x-search class="grow z-50" :search="$search"/>
    </div>
    <div class="h-96 overflow-y-auto">
        <ul class="flex pt-2 justify-start pb-2  flex-col rounded bg-white gap-2">
            {{ $addedList }}
            {{ $list }}
        </ul>
        {{ $slot }}
    </div>
</div>
