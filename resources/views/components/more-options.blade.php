<div {{ $attributes->class(['self-end relative']) }}
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
    >More
    </button>
    <ul
            x-ref="options"
            x-show="expanded"
            @click.outside="close($refs.button)"
            :id="$id('dropdown-button')"
            style="display: none"
            class="absolute left-0 bg-white rounded drop-shadow overflow-hidden"
    >
        {{ $slot }}
    </ul>
</div>
