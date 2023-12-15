<div>
    <x-modal-form
        submit="update"
        name="edit"
    >
        <x-slot:title>
            <h2 class="text-h3 mb-12 font-bold">{{ __('contacts.edit') }}</h2>
        </x-slot:title>
        <x-slot:body>
            <x-input-image class="mb-10 align-center"/>
            <x-input
                class="mb-10"
                :label="__('form.full_name')"
                name="name"
                model="name"
                :value="$this->name()"
                :placeholder="$this->name()"
            />
            <x-input
                class="mb-10"
                :label="__('form.email')"
                name="email"
                model="email"
                :value="$this->email()"
                :placeholder="$this->email()"/>
        </x-slot:body>
        <x-slot:footer>
            <div class="flex justify-center">
                <x-button-primary type="submit">{{ __('contacts.edit') }}</x-button-primary>
            </div>
        </x-slot:footer>
    </x-modal-form>
    <div class="flex">
        <img src="{{ $this->contact->image_url }}" alt="" class="w-20 h-20 object-cover rounded-full">
        <div class="flex flex-col items-start ml-4 gap-2">
            <span class="text-h1">{{ $this->contact->name }}</span>
            <span>Email: {{ $this->contact->email }}</span>
            <x-link-primary href="#edit">{{ __('general.edit') }}</x-link-primary>
        </div>
    </div>
    @if($this->events->count() > 0)
        <div>
            <h2>{{ __('events.title') }}</h2>
            <div class="overflow-x-auto w-full p-2">
                <table class="table-auto rounded drop-shadow overflow-hidden bg-white w-full text-center max-w-6xl">
                    <thead class="bg-black-5 text-primary">
                    <tr>
                        <td></td>
                        <td class="p-2.5">{{ __('form.situation') }}</td>
                        <td class="p-2.5">{{ __('form.name') }}</td>
                        <td class="p-2.5">{{ __('form.date') }}</td>
                        <td class="p-2.5">{{ __('form.average') }}</td>
                    </tr>
                    </thead>
                    @foreach($this->events as $event)
                        <tbody x-data="{ show : false }">
                        <tr>
                            <td>
                                <button type="button" @click="show =! show">{{ __('general.expand') }}</button>
                            </td>
                            <td class="p-2.5">
                                <x-date-pill :status="$event->status"/>
                            </td>
                            <td class="p-2.5">{{ $event->name }}</td>
                            <td class="p-2.5">
                                <x-date :date="$event->date"/>
                            </td>
                            <td class="p-2.5">{{ $this->getAverage($event->id, 20) }} / 20</td>
                        </tr>
                        <tr x-show="show">
                            <td></td>
                            <td colspan="4">
                                <table class="bg-black-5 w-full rounded-bl-lg">
                                    <thead>
                                    <tr class="text-primary">
                                        <td>{{ __('form.projects') }}</td>
                                        <td>{{ __('form.points') }}</td>
                                        <td>{{ __('form.weight') }}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($event->projects as $project)
                                        <tr>
                                            <td>{{ $project->title }}</td>
                                            <td>{{  $this->getProjectAverage($event->id, $project->id, 20) }} / 20</td>
                                            <td>{{ $project->pivot->weight }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
</div>
