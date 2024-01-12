<div>
    @if($status === null)
        <span class="py-1 px-6 bg-success text-white rounded">Future</span>
    @elseif($status === 'started')
        <span class="py-1 px-6 bg-primary text-white rounded">Started</span>
    @elseif($status === 'ended')
        <span class="py-1 px-6 bg-warning text-white rounded">Passée</span>
    @endif
</div>
