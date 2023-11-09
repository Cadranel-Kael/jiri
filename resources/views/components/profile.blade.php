<div class="bg-white justify-between drop-shadow p-4 flex flex-col items-center box-border rounded">
    <x-more-options>
        <li>
            <a
                href="?id={{ $id }}#edit"
                class="text-center block cursor-pointer hover:bg-black-5 p-1 w-full"
            >Edit</a>
        </li>
        <li>
            <button class="hover:bg-black-5 p-1 w-full text-warning">Delete</button>
        </li>
    </x-more-options>
    <img class="rounded-full object-cover w-24 h-24 mb-6" src="{{ $src }}" alt="" width="106" height="106" loading="lazy">
    <div class="text-ellipsis overflow-hidden w-full text-center mb-2">{{ $name }}</div>
    <div class="text-black-50 text-ellipsis overflow-hidden w-full text-center mb-6">{{ $email }}</div>
    <x-link-outline value="{{ __('contacts.see_profile') }}" href="{{ route('contacts.show', $id) }}"/>
</div>
