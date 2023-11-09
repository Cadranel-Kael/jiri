<div>
    <x-modal-form submit="save" name="create">
        <x-slot:title>
            <h3>{{ __('projects.add_new') }}</h3>
        </x-slot:title>
        <x-slot:body>
            <x-input required label="{{ __('form.title') }}" name="title" placeholder="Projet"></x-input>
            <x-text-area label="{{ __('form.description') }}" name="description" placeholder="Description"></x-text-area>
            <x-input label="{{ __('form.link', ['link'=>'Github']) }}" name="github" placeholder="https://github.com/tecg-dw/projet-cv"></x-input>
        </x-slot:body>
        <x-slot:footer>
            <x-button-primary type="submit">{{ __('projects.add_new') }}</x-button-primary>
        </x-slot:footer>
    </x-modal-form>
    <x-top-bar
        createHref="#create"
        :createLabel="__('projects.add_new')"
        importHref="#import"
        :importLabel="__('project.import')"
        sort="sort"
        :order="$this->order"
        :options="$this->sortables"
        search="search"
    />
    <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-4 mx-4">
        @foreach($this->projects as $project)
            <x-project-card title="{{ $project->title }}" description="{{ $project->description }}"/>
        @endforeach
    </div>
{{--    @if($this->contacts->isEmpty())--}}
{{--        <div>--}}
{{--            <span>{{ __('form.no_results') }}</span>--}}
{{--            <x-link-primary href="#create">{{ __('contacts.add_new') }}</x-link-primary>--}}
{{--        </div>--}}
{{--    @else--}}
{{--        <button wire:click="load_more">Load more</button>--}}
{{--    @endif--}}

</div>

