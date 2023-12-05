<div {{ $attributes(['class'=>'flex flex-col']) }}>
    <label for="{{ $name }}" class="font-bold">
        {{ $label }}
        @isset($required)
            <span class='text-warning'>*</span>
            <span class="sr-only">{{ __('form.obligatory') }}</span>
        @endisset
    </label>
    <input value="{{ $value ?? '' }}" wire:model.live="{{ $model ?? $name }}" class="border-b-2 border-0" placeholder="{{ $placeholder ?? $label }}" type="text" name="{{ $name }}"
           id="{{ $name }}">
    @error($model ?? $name)
    {{ $message }}
    @enderror
</div>
