<div class="fixed bottom-0 z-100 right-0 m-8 flex flex-col gap-2">
    @foreach($this->flashes as $flash)
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition.opacity.duration.500ms
            class="bg-{{ $flash['type'] }} text-white font-bold rounded-lg shadow-lg px-10 py-2">
            {{ $flash['message'] }}
        </div>
    @endforeach
</div>
