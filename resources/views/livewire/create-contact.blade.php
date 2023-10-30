<div>
    <div class="fixed h-screen w-screen bg-black opacity-75 top-0 left-0 z-10" @click="createContact = false"></div>
    <div class="fixed z-20 absolute bg-white rounded flex flex-col p-4">
        <h3>Ajouter un contact</h3>
        <label for="fullname">Nom et prénom</label>
        <input type="text" name="name" id="fullname">
        <label for="email">{{ __('') }}</label>
        <input type="text" name="email" id="email">
        <x-button-primary type="submit" value="Ajouter un contact"/>
    </div>

</div>
