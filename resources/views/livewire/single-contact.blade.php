<div>
    <div class="flex">
        <img src="{{ $this->contact->image_url }}" alt="" class="w-20 h-20 object-cover rounded-full">
        <div class="flex flex-col items-start ml-4 gap-2">
            <span class="text-h1">{{ $this->contact->name }}</span>
            <span>Email: {{ $this->contact->email }}</span>
            <x-button-primary type="button">Modifier</x-button-primary>
        </div>
    </div>
    <div>
        <h2>{{ __('events.title') }}</h2>
        <div class="overflow-x-auto w-full p-2">
            <table class="table-auto rounded drop-shadow overflow-hidden bg-white w-full text-center max-w-6xl">
                <thead class="bg-black-5 text-primary">
                <tr>
                    <td class="p-2.5">{{ __('general.expand') }}</td>
                    <td class="p-2.5">{{ __('form.situation') }}</td>
                    <td class="p-2.5">{{ __('form.name') }}</td>
                    <td class="p-2.5">{{ __('form.date') }}</td>
                    <td class="p-2.5">{{ __('form.average') }}</td>
                </tr>
                </thead>
                <tbody>
                @foreach($this->events as $event)
                    <tr>
                        <td class="p-2.5">Expand</td>
                        <td class="p-2.5"><x-date-pill :date="$event->date"/></td>
                        <td class="p-2.5">{{ $event->name }}</td>
                        <td class="p-2.5"><x-date :date="$event->date"/></td>
                        <td class="p-2.5"></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
