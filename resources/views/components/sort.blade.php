<div>
    <label for="sort">{{ __('form.sort') }}</label>
    <select wire:model.live="{{ $sort }}" name="sort" id="sort" class="border-none drop-shadow rounded cursor-pointer">
        @foreach($options as $option)
            <option value="{{ $option }}">{{ __('form.' . $option) }}</option>
        @endforeach
    </select>
    <x-button-primary type="button" wire:click="changeOrder">
        <svg role="img" class="fill-white w-4 h-auto @if($order == 'DESC') rotate-180 @endif" width="17.4611"
             height="19.6782">
            <use xlink:href="{{ asset('icons/icons.svg#arrow') }}"/>
        </svg>
    </x-button-primary>
</div>
