<div class="bg-white drop-shadow p-4 flex flex-col items-center box-border overflow-hidden rounded">
    <img class="rounded-full object-cover w-24 h-24 mb-6" src="{{ $src }}" alt="" width="106" height="106" loading="lazy">
    <div class="text-ellipsis overflow-hidden w-full text-center mb-2">{{ $name }}</div>
    <div class="text-black-50 text-ellipsis overflow-hidden w-full text-center mb-6">{{ $email }}</div>
    <x-link-outline value="{{ __('contacts.see_profile') }}"/>
</div>
