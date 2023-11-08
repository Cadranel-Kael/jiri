<div>
    <label for="sort">{{ __('form.sort') }}</label>
    <select wire:model.live="{{ $sort }}" name="sort" id="sort" class="border-none drop-shadow rounded cursor-pointer">
        @foreach($options as $option)
            <option value="{{ $option }}">{{ __('form.' . $option) }}</option>
        @endforeach
    </select>
</div>
