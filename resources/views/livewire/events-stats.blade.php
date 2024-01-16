<div class="{{ $class }}">
    <div class="mb-4">
        <h3 class="font-bold mb-2">Épreuves produites</h3>
        <span>{{ $this->events()->count() }}</span>
    </div>
    <div>
        <h3 class="font-bold mb-2">Réussites</h3>
        <span>{{ $this->passes() }}</span>
    </div>
</div>
