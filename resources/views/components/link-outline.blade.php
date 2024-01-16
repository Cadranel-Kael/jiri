
<a href="{{ $href ?? '#' }}" {{ $attributes(['class' => 'text-center transition p-2.5 drop-shadow rounded cursor-pointer border-black border bg-white text-black hover:bg-black hover:text-white']) }}>
    {{ $slot }}
</a>
