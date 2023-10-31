<div>
    <x-modal-form name="create">
        <x-slot:title>
            <h3>{{ __('contacts.add_new') }}</h3>
        </x-slot:title>
        <x-slot:body>
            <label for="fullname">{{ __('form.full_name') }}</label>
            <input type="text" name="name" id="fullname">
            <label for="email">{{ __('form.email') }}</label>
            <input type="text" name="email" id="email">
        </x-slot:body>
        <x-slot:footer>
            <x-button-primary type="submit">{{ __('contacts.add_new') }}</x-button-primary>
        </x-slot:footer>
    </x-modal-form>
    <x-link-primary href="#create">{{ __('contacts.add_new') }}</x-link-primary>
    <x-search search="contact"/>
    <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($this->contacts as $contact)
            <x-profile-183 livewire:revenue lazy="on-load" src="{{ $contact->image_url }}" email="{{ $contact->email }}"
                           name="{{ $contact->name }}"/>
        @endforeach
    </div>
    @if($this->contacts->isEmpty())
        <div>
            <span>{{ __('form.no_results') }}</span>
            <x-link-primary href="#create">{{ __('contacts.add_new') }}</x-link-primary>
        </div>
    @else
        <button wire:click="load_more">Load more</button>
    @endif

</div>
