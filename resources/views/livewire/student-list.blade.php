<div>
    <x-modal name="addStudents">
        <x-slot:body>
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
                                      x-on:click="$dispatch('open-modal', { name : 'studentForm' })">{{ __('contacts.add_new') }}</x-button-primary>
                @endif
                <x-slot:addedList>
                </x-slot:addedList>
                <x-slot:list>
                    @foreach($this->contacts as $contact)
                        @if(in_array($contact->id, $this->addedStudentsIds))
                            <x-added-student :student="$contact" :added-projects="$addedProjects" remove="removeStudent({{ $contact->id }})"/>
                        @else
                            <x-item-contacts :contact="$contact" add="addStudent({{ $contact->id }})"/>
                        @endif
                    @endforeach
                </x-slot:list>
            </x-multi-choice>
            <x-button-primary class="my-4" type="submit">add</x-button-primary>
        </x-slot:body>
    </x-modal>
</div>
