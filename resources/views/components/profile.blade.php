<div class="bg-white justify-between drop-shadow p-4 flex flex-col items-center box-border rounded">
    <div class="self-end relative"
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
        >More</button>
        <ul
            x-ref="options"
            x-show="expanded"
            @click.outside="close($refs.button)"
            :id="$id('dropdown-button')"
            style="display: none"
            class="absolute left-0 bg-white rounded drop-shadow overflow-hidden"
        >
            <li><a href="?id={{ $id }}#edit" @click="$dispatch('note-editing')" class="text-center block cursor-pointer hover:bg-black-5 p-1 w-full">Edit</a></li>
            <li><button class="hover:bg-black-5 p-1 w-full text-warning">Delete</button></li>
        </ul>
    </div>
    <img class="rounded-full object-cover w-24 h-24 mb-6" src="{{ $src }}" alt="" width="106" height="106" loading="lazy">
    <div class="text-ellipsis overflow-hidden w-full text-center mb-2">{{ $name }}</div>
    <div class="text-black-50 text-ellipsis overflow-hidden w-full text-center mb-6">{{ $email }}</div>
    <x-link-outline value="{{ __('contacts.see_profile') }}" href="{{ route('contacts.show', $id) }}"/>
</div>
