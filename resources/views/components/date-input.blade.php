<div {{ $attributes(['class'=>'flex flex-col']) }}>
    <label class="font-bold mb-2" for="{{ $name }}">{{ $label }}</label>
    <input class="rounded border-none drop-shadow" wire:model.live="{{ $model ?? $name }}" type="date" name="{{ $name }}" id="{{ $name }}">
    @error($model ?? $name)
    {{ $message }}
    @enderror
</div>
