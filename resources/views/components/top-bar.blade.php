<div class="flex flex-col lg:flex-row justify-between mb-8">
    <div class="flex flex-col gap-4 mr-4 mb-5 lg:flex-row">
        <x-link-primary class="w-full lg:w-fit" :href="$createHref">{{ $createLabel }}</x-link-primary>
        <x-link-white class="w-full lg:w-fit" :href="$importHref">{{ $importLabel }}</x-link-white>
    </div>
    <div class="flex flex-col gap-4 mr-4 mb-5 lg:flex-row">
        <x-sort :sort="$sort" :order="$order" :options="$options"/>
        <x-search class="w-full lg:w-fit" :search="$search"/>
    </div>
</div>
