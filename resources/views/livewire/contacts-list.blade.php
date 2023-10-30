<div x-data="{ createContact: false }">
    <div>
        <x-button-primary @click="createContact = true"  type="button" value="{{ __('contacts.add_new') }}"/>
        <div x-show="createContact" @click.away="createContact = false">
            <div>
                @livewire('create-contact')
            </div>
        </div>
    </div>
    <x-search search="contact"/>
    <div class="flex flex-wrap gap-4">
        @foreach($this->contacts as $contact)
            <x-profile-183 livewire:revenue lazy="on-load" src="{{ $contact->image_url }}" email="{{ $contact->email }}"
                           name="{{ $contact->name }}"/>
        @endforeach
    </div>
    @if($this->contacts->isEmpty())
        <div>
            <span>{{ __('form.no_results') }}</span>
            <x-button-primary @click="createContact = true"  type="button" value="{{ __('contacts.add_new') }}"/>
        </div>
    @else
        <button wire:click="load_more">Load more</button>
    @endif
    @if($contact_form_shown)
        <livewire:create-contact/>
    @endif
</div>
