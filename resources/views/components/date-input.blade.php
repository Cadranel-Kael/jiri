<div {{ $attributes(['class'=>'flex flex-col']) }}>
    <label class="font-bold" for="{{ $name }}">{{ $label }}</label>
    <input class="rounded border-none drop-shadow" wire:model="{{ $name }}" type="date" name="{{ $name }}" id="{{ $name }}">
    @error($name)
    {{ $message }}
    @enderror
</div>
