<div
    class="bg-white drop-shadow flex flex-col min-w-col-2-sm items-center align-center py-3 px-2 rounded gap-2 place-content-between"
>
    <x-more-options
        :items="[
            [
                'href' => '?id=#edit',
                'label' => __('form.edit')
            ],
            [
                'label' => __('form.delete'),
                'color' => 'warning'
            ]
        ]"
    />
    <span class="text-center text-ellipsis font-bold">{{ $title }}</span>
    <span class="text-center h-12 overflow-hidden text-ellipsis">{{ $description }}</span>
    <x-link-outline href="" value="Voire le projet"/>
</div>
