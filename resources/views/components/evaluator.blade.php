<div class="w-48 bg-white justify-between drop-shadow p-4 flex flex-col items-center box-border rounded">
{{--    <button class="self-end" wire:key="{{ $evaluator->id }}" wire:click="removeEvaluator({{ $evaluator->id }})">--}}
{{--        <svg role="img" class="fill-black w-4 h-auto" width="17.4611" height="19.6782">--}}
{{--            <use xlink:href="{{ asset('icons/icons.svg#icon-close') }}"/>--}}
{{--        </svg>--}}
{{--        <span class="sr-only">remove</span>--}}
{{--    </button>--}}
    <img class="rounded-full object-cover w-24 h-24 mb-6" src="{{ $evaluator->image_url }}" alt="{{ $evaluator->name }}" width="106" height="106"
         loading="lazy">
    <div class="text-ellipsis overflow-hidden w-full text-center mb-2">{{ $evaluator->name }}</div>
    <div class="text-black-50 text-ellipsis overflow-hidden w-full text-center mb-6">{{ $evaluator->email }}</div>
    <x-link-outline wire:key="{{ $evaluator->id }}" href="{{ route('contacts.show', $evaluator->id) }}">{{ __('contacts.see_profile') }}</x-link-outline>
</div>

