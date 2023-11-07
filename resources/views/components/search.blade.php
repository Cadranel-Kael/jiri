<div class="relative">
    <form class="relative w-full">
        <label class="sr-only" for="search">{{ __('form.search') }}</label>
        <div class="absolute z-10 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg role="img" class="w-4 h-4 fill-black" width="1rem" height="1rem">
                <use xlink:href="{{ asset('icons/icons.svg#icon-search') }}"/>
            </svg>
        </div>
        <input name="contact" class="border-none p-2.5 pl-10 block drop-shadow rounded block w-full placeholder:text-black-50" type="text"
               id="search" wire:model.live.debounce.250ms="{{ $search }}" placeholder="{{ __('form.search') }}">
        <button type="submit" class="sr-only">Search</button>
    </form>
</div>
