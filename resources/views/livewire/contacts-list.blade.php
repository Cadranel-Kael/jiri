<div>
    <label for="sort"></label>
    <select name="sort" id="sort" wire:model.live="sort">
        <option id="name" value="name">Nom</option>
        <option id="email" value="email">Email</option>
        <option id="created" value="created_at">Ajoutée</option>
    </select>
    <label class="sr-only" for="search">Search a user</label>
        <div class="relative w-full">
            <div class="absolute z-10 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg role="img" class="w-4 h-4 fill-black" width="1rem" height="1rem">
                    <use xlink:href="{{ asset('icons/icons.svg#icon-search') }}"/>
                </svg>
            </div>
            <input class="p-2.5 pl-10 block drop-shadow rounded block w-full placeholder:text-black-50" type="text" id="search" wire:model.live="username" placeholder="Rechercher">
        </div>
    <div class="flex flex-wrap gap-4">
        @foreach($this->contacts as $contact)
            <x-profile-183 livewire:revenue lazy="on-load" src="{{ $contact->image_url }}" email="{{ $contact->email }}" name="{{ $contact->name }}"/>
        @endforeach
    </div>

</div>
