<div class="flex flex-col">
    <label for="{{ $name }}" class="font-bold">
        {{ $label }}
        @isset($required)
            <span class='text-red'>*</span>
            <span class="sr-only">{{ __('form.obligatory') }}</span>
        @endisset
    </label>
    <textarea wire:model="{{ $model ?? $name }}" class="border-2 border-black rounded" placeholder="{{ $placeholder ?? $label }}" value="{{ $value ?? '' }}" type="text" name="{{ $name }}"
              id="{{ $name }}" rows="3"></textarea>
    @error($name)
    {{ $message }}
    @enderror
</div>
