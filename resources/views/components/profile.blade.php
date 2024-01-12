<div class="bg-white justify-between drop-shadow p-4 flex flex-col items-center box-border rounded">
    <x-more-options :items="[
        [
            'href'=>'?id=' . $contact->id . '#edit',
            'label'=>__('form.edit')
        ],
        [
            'action' => 'destroy(' . $contact->id . ')',
            'confirm' => __('form.confirm_delete'),
            'label'=>__('form.delete'),
            'color'=>'warning',
        ],
    ]">
    </x-more-options>
    <img class="rounded-full object-cover w-24 h-24 mb-6" src="{{ $contact->image_url }}" alt="{{ __('image.profile', ['name'=>$contact->name]) }}" width="106" height="106"
         loading="lazy">
    <div class="text-ellipsis overflow-hidden w-full text-center mb-2">{{ $contact->name }}</div>
    <div class="text-black-50 text-ellipsis overflow-hidden w-full text-center mb-6">{{ $contact->email }}</div>
    <x-link-outline href="{{ route('contacts.show', $contact->id) }}">{{ __('contacts.see_profile') }}</x-link-outline>
</div>
