@props([
    'items',
    'itemsClass'=> 'text-center block cursor-pointer hover:bg-black-5 p-1 w-full'
    ])
<div
    {{ $attributes->class(['self-end relative']) }}
     x-data="{ expanded: false,
            toggle() {
                if (this.expanded) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.expanded = true
            },
            close(focusAfter) {
                this.expanded = false

                focusAfter && focusAfter.focus()
            }
        }"
     @keydown.escape.prevent.stop="close($refs.button)"
     @focusin.window="! $refs.options.contains($event.target) && close()"
     x-id="['more-options']"
>
    <button
        x-ref="button"
        @click="toggle()"
        :aria-expanded="expanded"
        :aria-controls="$id('more-options')"
        type="button"
        class="py-2"
    >
        <svg aria-hidden="true" role="img" width="22"
             height="6">
            <use xlink:href="{{ asset('icons/icons.svg#dots') }}"/>
        </svg>
        <span class="sr-only">More</span>
    </button>
    <ul
        x-ref="options"
        x-show="expanded"
        @click.outside="close($refs.button)"
        :id="$id('dropdown-button')"
        style="display: none"
        class="absolute right-0 bg-white rounded drop-shadow overflow-hidden"
    >
        @foreach($items as $item)
            @php
                $itemClass = $itemsClass;
            @endphp
            @isset($item['color'])
                @php
                    $itemClass= $itemsClass . ' text-'.$item['color'];
                @endphp
            @endif
            <li>
                @if(isset($item['href']))
                    <a
                        class="{{ $itemClass }}"
                        href="{{ $item['href'] }}"
                    >{{ $item['label'] }}</a>
                @else
                    <button
                        class="{{ $itemClass }}"
                        type="button"
                    >
                        {{ $item['label'] }}
                    </button>
                @endif
            </li>
        @endforeach
    </ul>
</div>
