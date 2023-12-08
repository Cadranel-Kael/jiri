@props(['type' => 'button'])
<button type="{{$type}}">
    <svg role="img" class="fill-white w-4 h-auto" width="17.4611" height="19.6782">
        <use xlink:href="{{ asset('icons/icons.svg#icon-close') }}"/>
    </svg>
    <span class="sr-only" >close</span>
</button>
