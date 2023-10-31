@props(['name'])
<div
    x-data="{ show = true}"
    x-show="show"
{{--    x-on:hashchange.window="show = (location.hash === ('#{{ $name }}'))"--}}
>
    <div class="fixed h-screen w-screen bg-black opacity-75 top-0 left-0 z-10" @click="show = false"></div>
    <div class="fixed z-20 absolute bg-white rounded flex flex-col p-4">
        <h3>{{ __('contacts.add_new') }}</h3>
        <label for="fullname">{{ __('form.full_name') }}</label>
        <input type="text" name="name" id="fullname">
        <label for="email">{{ __('form.email') }}</label>
        <input type="text" name="email" id="email">
        <x-button-primary type="submit" value="{{ __('contacts.add_new') }}"/>
    </div>

</div>
