<div>
{{--    <button type="button" livewire:click="$set('contact_form_shown', true)">Create</button>--}}
    <div x-data="{ open: false }">
        <button @click="open = true">Create new</button>
        <div x-show="open" @click.away="open = false">
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
            <span>Pas de resultat</span>
            <button type="button" livewire:click="$set('contact_form_shown', true)">Crée un nouveau utilisateur</button>
        </div>
    @else
        <button wire:click="load_more">Load more</button>
    @endif
    @if($contact_form_shown)
        <livewire:create-contact/>
    @endif
</div>
