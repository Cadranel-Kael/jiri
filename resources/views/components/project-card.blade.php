<div
    class="bg-white drop-shadow flex flex-col min-w-col-2-sm items-center align-center py-3 px-2 rounded gap-2 place-content-between"
    wire:key="{{ $project->id }}"
>
    <x-more-options
        :items="[
            [
                'href' => '?id=#edit',
                'label' => __('form.edit'),
            ],
            [
                'label' => __('form.delete'),
                'color' => 'warning',
                'action' => 'delete(' . $project->id . ')',
                'confirm' => __('projects.delete'),
            ]
        ]"
    />
    <span class="text-center text-ellipsis font-bold">{{ $project->title }}</span>
    <span class="text-center h-12 overflow-hidden text-ellipsis">{{ $project->description }}</span>
    <x-link-outline href="{{route('projects.show', $project->id)}}">{{__('projects.see_project')}}</x-link-outline>
</div>
