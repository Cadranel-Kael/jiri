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
    <div class="flex flex-col gap-4 mx-4 mb-5">
        <x-link-primary class="w-full" href="#create">{{ __('projects.add_new') }}</x-link-primary>
        <x-search search="search"/>
    </div>
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

