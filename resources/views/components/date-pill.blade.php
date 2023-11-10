<div>
    @if($date > \Carbon\Carbon::today())
        <span class="py-1 px-6 bg-primary text-white rounded">Future</span>
    @else
        <span class="py-1 px-6 bg-red-600 text-white rounded">Passée</span>
    @endif
</div>
