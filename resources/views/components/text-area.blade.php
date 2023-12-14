@props([
    'name',
    'label',
    'labelSrOnly' => false,
    'required' => false,
    'placeholder' => null,
    'model' => null,
    'value' => null
    ])
<div class="flex flex-col">
    <label for="{{ $name }}" class="font-bold">
        {{ $label }}
        @if($required)
            <span class='text-warning'>*</span>
            <span class="sr-only">{{ __('form.obligatory') }}</span>
        @endif
    </label>
    <textarea wire:model.live="{{ $model ?? $name }}" class="border-2 border-black rounded"
              placeholder="{{ $placeholder ?? $label }}" value="{{ $value ?? '' }}" type="text" name="{{ $name }}"
              id="{{ $name }}" rows="3"></textarea>
    @error($model ?? $name)
    {{ $message }}
    @enderror
</div>
