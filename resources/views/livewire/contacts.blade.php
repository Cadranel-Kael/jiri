<div class="h-full">
    <x-modal-form
        submit="save"
        name="create"
    >
        <x-slot:title>
            <h2 class="text-h3 mb-12 font-bold">{{ __('contacts.add_new') }}</h2>
        </x-slot:title>
        <x-slot:body>
            <x-input-image class="mb-10 align-center"></x-input-image>
            <x-input
                class="mb-10"
                :label="__('form.full_name')"
                name="name"
                model="createContactForm.name"
                placeholder="Wilson Jenny"
            ></x-input>
            <x-input
                class="mb-10"
                :label="__('form.email')"
                name="email"
                model="createContactForm.email"
                placeholder="jenny.wilson@mail.com"
            ></x-input>
        </x-slot:body>
        <x-slot:footer>
            <div class="flex justify-center">
                <x-button-primary type="submit">{{ __('contacts.add_new') }}</x-button-primary>
            </div>
        </x-slot:footer>
    </x-modal-form>
    <x-modal-form
        submit="update"
        name="edit"
    >
        <x-slot:title>
            <h2 class="text-h3 mb-12 font-bold">{{ __('contacts.add_new') }}</h2>
        </x-slot:title>
        <x-slot:body>
            <x-input-image class="mb-10 align-center"/>
            <x-input
                class="mb-10"
                :label="__('form.full_name')"
                name="name"
                model="updateContactForm.name"
            />
            <x-input
                class="mb-10"
                :label="__('form.email')"
                name="email"
                model="updateContactForm.email"
            />
        </x-slot:body>
        <x-slot:footer>
            <div class="flex justify-center">
                <x-button-primary type="submit">{{ __('contacts.add_new') }}</x-button-primary>
            </div>
        </x-slot:footer>
    </x-modal-form>
    <x-top-bar
        createHref="#create"
        :createLabel="__('contacts.add_new')"
        importHref="#import"
        :importLabel="__('contacts.import')"
        sort="sort"
        :order="$this->order"
        :options="$this->sortables"
        search="search"
    />
    <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-4 mx-4">
        @foreach($this->contacts as $contact)
            <x-contact-profile :contact="$contact"/>
        @endforeach
    </div>
    @if($this->contacts->isEmpty())
        <div class="text-center mt-24">
            @if($this->hasContacts())
                <div class="max-w-6 mx-auto">{{ __('contacts.no_contacts') }}</div>
            @else
                <div>{{ __('form.no_results_for') }} <span class="font-bold">{{ $this->search }}</span>
                </div>
            @endif
            <x-link-primary class="mt-2 w-fit mx-auto" href="#create">{{ __('contacts.add_new') }}</x-link-primary>
        </div>
    @else
        <div class="flex justify-center p-10">
            <x-primary-button type="button" wire:click="loadMore">Load more</x-primary-button>
        </div>
    @endif

</div>
