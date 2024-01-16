<div
    class="bg-white drop-shadow min-w-40 max-w-40 flex flex-col items-center align-center py-3 px-2 rounded gap-2 place-content-between"
>
    <span class="text-center text-ellipsis font-bold">{{ $project->title }}</span>
    <span class="text-center h-12 overflow-hidden text-ellipsis">{{ $project->description }}</span>
    <x-link-outline href="{{ route('projects.show', $project->id) }}">{{ __('projects.see_project') }}</x-link-outline>
</div>

