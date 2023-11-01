<div class="flex flex-col">
    <label for="{{ $name }}" class="font-bold">{{ $label }}</label>
    <input wire:model="{{ $model ?? $name }}" class="border-b-2 border-0" placeholder="{{ $placeholder ?? $label }}" value="{{ $value ?? '' }}" type="text" name="{{ $name }}"
           id="{{ $name }}">
    @error($name)
        {{ $message }}
    @enderror
</div>
