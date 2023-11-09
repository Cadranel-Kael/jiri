<a href="{{ $href }}" wire:navigate {{ $attributes(['class' => 'transition duration-150 ease-out block text-center p-2.5 drop-shadow rounded block-inline cursor-pointer bg-primary text-white hover:bg-white hover:text-primary']) }}>
    {{ $slot }}
</a>
