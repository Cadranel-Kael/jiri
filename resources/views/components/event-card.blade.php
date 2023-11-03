<div
    class="bg-white drop-shadow flex flex-col min-w-col-2-sm items-center align-center py-3 px-2 rounded gap-2 place-content-between">
    @if($date > \Carbon\Carbon::today())
        <span class="py-1 px-6 bg-primary text-white rounded">Future</span>
    @else
        <span class="py-1 px-6 bg-red-600 text-white rounded">Passée</span>
    @endif
    <span class="text-center h-12 text-ellipsis">{{ $name }}</span>
    <span class="text-black-50">{{ Carbon\Carbon::parse($date)->translatedFormat('d M Y') }}</span>
    <x-link-outline href="" value="Voire l'épreuve"/>
</div>
