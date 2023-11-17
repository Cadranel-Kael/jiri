<div>
    <div class="flex flex-wrap flex-stretch w-full">
        <x-sort :sort="$sort" :order="$order" :options="$sortables"/>
        <x-search class="grow" search="search"/>
    </div>
    <ul>
        {{ $addedList }}
        {{ $list }}
    </ul>
</div>
