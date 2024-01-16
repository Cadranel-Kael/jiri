<div>
    @foreach($contacts as $contact)
        <x-contact-profile :contact="$contact"/>
    @endforeach
</div>
