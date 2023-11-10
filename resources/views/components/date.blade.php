<div {{ $attributes }}>
    {{ Carbon\Carbon::parse($date)->translatedFormat('d M Y') }}
</div>
