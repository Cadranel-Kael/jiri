@props([
    'name',
    'label',
    'labelSrOnly' => false,
    'required' => false,
    'placeholder' => '********',
    'model' => null,
    'value' => null,
    'autocomplete' => 'off',
    ])
<div {{ $attributes(['class'=>'flex flex-col']) }} x-data="{ show: true }">
    <label for="{{ $name }}" class="font-bold @if($labelSrOnly) sr-only @endif">
        {{ $label }}
        @if($required)
            <span class='text-warning'>*</span>
            <span class="sr-only">{{ __('form.obligatory') }}</span>
        @endif
    </label>
    <div class="bg-transparent border-b-2 border-0 flex items-center">
        <input class="bg-transparent border-0 w-full" autocomplete="{{ $autocomplete }}" value="{{ $value ?? '' }}" wire:model.blur="{{ $model ?? $name }}"
               placeholder="{{ $placeholder ?? $label }}" :type="show ? 'password' : 'text'" name="{{ $name }}"
               id="{{ $name }}">
        <span @click="show = !show" class="text-primary cursor-pointer select-none" :class="{'hidden': !show, 'block':show }">show</span>
        <span @click="show = !show" class="text-primary cursor-pointer select-none" :class="{'hidden': show, 'block':!show }">hide</span>
    </div>
    <div class="min-h-line text-warning">
        @error($model ?? $name)
        {{ $message }}
        @enderror
    </div>
</div>

