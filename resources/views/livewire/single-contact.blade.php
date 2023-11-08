<div>
    <div class="flex">
        <img src="{{ $this->contact->image_url }}" alt="" class="w-20 h-20 object-cover rounded-full">
        <div class="flex flex-col items-start ml-4 gap-2">
            <span class="text-h1">{{ $this->contact->name }}</span>
            <span>Email: {{ $this->contact->email }}</span>
            <x-button-primary type="button">Modifier</x-button-primary>
        </div>
    </div>
</div>
