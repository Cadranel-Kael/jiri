<div class="bg-white justify-between drop-shadow p-4 flex flex-col items-center box-border rounded">
    <div class="flex">
        <img class="rounded-full object-cover w-24 h-24 mb-6" src="{{ $student->src }}" alt="" width="106" height="106"
             loading="lazy">
        <div class="flex flex-col text-left">
            <div class="text-ellipsis overflow-hidden w-full mb-2">{{ $student->name }}</div>
            <div class="text-black-50 text-ellipsis overflow-hidden w-full mb-6">{{ $student->email }}</div>
        </div>
    </div>
    <div>
        {{ $student->projects }}
    </div>
    <x-link-outline value="{{ __('contacts.see_profile') }}" href="{{ route('contacts.show', $student->id) }}"/>
</div>


