@props([
    'name',
    'label',
    'labelSrOnly' => false,
    'required' => false,
    'placeholder' => null,
    'model' => null,
    'value' => null,
    'type' => 'text',
    'autocomplete' => 'off',
    ])
<div {{ $attributes(['class'=>'flex flex-col']) }}>
    <label for="{{ $name }}" class="font-bold @if($labelSrOnly) sr-only @endif">
        {{ $label }}
        @if($required)
            <span class='text-warning'>*</span>
            <span class="sr-only">{{ __('form.obligatory') }}</span>
        @endif
    </label>
    <div class="bg-transparent border-b-2 border-0">
        <input class="bg-transparent border-0 w-full" autocomplete="{{ $autocomplete }}" value="{{ $value ?? '' }}" wire:model.blur="{{ $model ?? $name }}"
               placeholder="{{ $placeholder ?? $label }}" type="{{ $type }}" name="{{ $name }}"
               id="{{ $name }}">
    </div>
    <div class="min-h-line text-warning">
        @error($model ?? $name)
        {{ $message }}
        @enderror
    </div>
</div>
