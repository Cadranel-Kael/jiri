<div>
    <a href="{{ url()->previous() }}" class="text-primary font-bold text-h1 flex items-center gap-2">
        <svg height="17.46" width="19.68" class="h-full w-8 fill-primary">
            <use xlink:href="{{ asset('icons/icons.svg#arrow') }}" class="-rotate-90 origin-center"/>
        </svg>
        {{ __('general.back') }}
    </a>
</div>
