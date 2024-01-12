<div>
    <x-modal name="addEvaluators">
        <x-slot:body>
            <form wire:submit.prevent="add">
                <x-multi-choice
                    change-order="changeOrder()"
                    :sort="$this->sort"
                    :order="$this->order"
                    :sortables="$this->sortables"
                    search="search"
                >
                    @if($this->contacts()->isEmpty())
                        <span>{{ __('general.no_results') }}</span>
                        <x-button-primary type="button" x-data
                                          x-on:click="$dispatch('open-modal', { name : 'projectForm' })">{{ __('projects.add_new') }}</x-button-primary>
                    @endif
                    <x-slot:list>
                        @foreach($this->contacts() as $contact)
                            @if(in_array($contact->id, $this->addedEvaluatorsIds))
                                <x-added-evaluator :evaluator="$contact" remove="removeEvaluator({{ $contact->id }})"/>
                            @else
                                <x-item-contacts :contact="$contact" add="addEvaluator({{ $contact->id }})"/>
                            @endif
                        @endforeach
                    </x-slot:list>
                </x-multi-choice>
                <x-button-primary class="my-4" type="submit">add</x-button-primary>
            </form>
        </x-slot:body>
    </x-modal>
</div>
