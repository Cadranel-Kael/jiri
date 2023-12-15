@props(['name', 'label', 'labelSrOnly' => false, 'required' => false, 'placeholder' => null, 'model' => null, 'value' => null])
<div {{ $attributes(['class'=>'flex flex-col']) }}>
    <label for="{{ $name }}" class="font-bold @if($labelSrOnly) sr-only @endif">
        {{ $label }}
        @if($required)
            <span class='text-warning'>*</span>
            <span class="sr-only">{{ __('form.obligatory') }}</span>
        @endif
    </label>
    <input autocomplete="off" value="{{ $value ?? '' }}" wire:model.blur="{{ $model ?? $name }}" class="border-b-2 border-0"
           placeholder="{{ $placeholder ?? $label }}" type="text" name="{{ $name }}"
           id="{{ $name }}">
    <div class="min-h-line">
        @error($model ?? $name)
        {{ $message }}
        @enderror
    </div>
</div>
