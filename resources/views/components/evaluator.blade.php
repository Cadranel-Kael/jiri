<div class="w-48 bg-white justify-between drop-shadow p-4 flex flex-col items-center box-border rounded">
    <button type="button" wire:key="{{ $evaluator->id }}" wire:click="removeEvaluator({{ $evaluator->id }})">{{ __('events.jury_remove') }}</button>
    <img class="rounded-full object-cover w-24 h-24 mb-6" src="{{ $evaluator->src }}" alt="" width="106" height="106"
         loading="lazy">
    <div class="text-ellipsis overflow-hidden w-full text-center mb-2">{{ $evaluator->name }}</div>
    <div class="text-black-50 text-ellipsis overflow-hidden w-full text-center mb-6">{{ $evaluator->email }}</div>
    <x-link-outline value="{{ __('contacts.see_profile') }}" wire:key="{{ $evaluator->id }}" href="{{ route('contacts.show', $evaluator->id) }}"/>
</div>

