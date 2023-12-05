@props([
    'type' => 'button'
    ])

<button
    type="{{ $type }}" {{ $attributes->merge(['class'=>'p-2.5 drop-shadow rounded block bg-primary text-white hover:bg-primary-75']) }}>
    {{ $slot }}
</button>
