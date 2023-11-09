<div>
    <x-modal-form
        submit="save"
        name="create">
        <x-slot:title>
            <h2 class="text-h3 mb-12 font-bold">{{ __('contacts.add_new') }}</h2>
        </x-slot:title>
        <x-slot:body>
            <x-input-image class="mb-10 align-center"></x-input-image>
            <x-input class="mb-10" label="{{ __('form.full_name') }}" name="name" placeholder="Wilson Jenny"></x-input>
            <x-input class="mb-10" label="{{ __('form.email') }}" name="email"
                     placeholder="jenny.wilson@mail.com"></x-input>
        </x-slot:body>
        <x-slot:footer>
            <div class="flex justify-center">
                <x-button-primary type="submit">{{ __('contacts.add_new') }}</x-button-primary>
            </div>
        </x-slot:footer>
    </x-modal-form>
    <x-modal-form submit="edit" name="edit">
        <x-slot:title>
            <h2 class="text-h3 mb-12 font-bold">{{ __('contacts.add_new') }}</h2>
        </x-slot:title>
        <x-slot:body>
            <x-input-image class="mb-10 align-center"/>
            <x-input class="mb-10" label="{{ __('form.full_name') }}" name="name" model="name" :placeholder="$this->name()" :value="$this->name()"/>
            <x-input class="mb-10" label="{{ __('form.email') }}" name="email" model="email"
                     :placeholder="$this->email()" :value="$this->email()"/>
        </x-slot:body>
        <x-slot:footer>
            <div class="flex justify-center">
                <x-button-primary type="submit">{{ __('contacts.add_new') }}</x-button-primary>
            </div>
        </x-slot:footer>
    </x-modal-form>
    <span>{{ $this->name }}</span>
    <div class="flex flex-col lg:flex-row justify-between mb-8">
        <div class="flex flex-col gap-4 mr-4 mb-5 lg:flex-row">
            <x-link-primary class="w-full lg:w-fit" href="#create">{{ __('contacts.add_new') }}</x-link-primary>
            <x-link-white class="w-full lg:w-fit" href="#import">{{ __('contacts.import') }}</x-link-white>
        </div>
        <div class="flex flex-col gap-4 mr-4 mb-5 lg:flex-row">
            <x-sort sort="sort" :order="$this->order" :options="$this->sortable_by"/>
            <x-search class="w-full lg:w-fit" search="search"/>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-4 mr-4">
        @foreach($this->contacts as $contact)
            <x-profile-183 :id="$contact->id" livewire:revenue lazy="on-load" src="{{ $contact->image_url }}" email="{{ $contact->email }}"
                           name="{{ $contact->name }}"/>
        @endforeach
    </div>
    @if($this->contacts->isEmpty())
        <div>
            <span>{{ __('form.no_results') }}</span>
            <x-link-primary href="#create">{{ __('contacts.add_new') }}</x-link-primary>
        </div>
    @else
        <div class="flex justify-center p-10">
            <x-primary-button type="button" wire:click="load_more">Load more</x-primary-button>
        </div>
    @endif

</div>
