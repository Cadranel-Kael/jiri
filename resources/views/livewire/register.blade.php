<form wire:submit="save">
    <h2 class="text-h2 mb-16">{{ __('auth.register') }}</h2>
    <x-input autocomplete="on" required="true" model="form.name" class="mb-4" name="name" :label="__('form.full_name')" placeholder="Joe Doe"/>
    <x-input autocomplete="on" required="true" model="form.email" class="mb-4" name="email" :label="__('form.email')" placeholder="joe.doe@mail.com"/>
    <x-password autocomplete="on" required="true" model="form.password" class="mb-4" name="password" :label="__('form.password')" />
    <x-button-primary type="submit" class="mb-6">{{ __('auth.register') }}</x-button-primary>
    <p>{{ __('auth.account') }} <a href="/login" class="text-primary">{{ __('auth.login') }}</a></p>
</form>
