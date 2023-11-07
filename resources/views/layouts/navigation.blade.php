<nav x-data="{ expanded:false }"
     class="sticky top-0 z-40 mr-10 p-4 h-screen rounded-r-lg drop-shadow bg-primary flex flex-col text-white block">
    <h2 class="sr-only">{{ __('general.nav_title') }}</h2>
    <div class="h-full flex flex-col justify-between">
        <a href="{{ route('dashboard') }}" class="text-logo">Jiri</a>
        <ul class="flex">
            <li>
                <button class="rounded flex items-center group hover:bg-white" type="button"
                        @click="expanded = ! expanded">
                    <div class="group rounded p-2 group-hover:bg-white h-10 w-10 flex">
                        <template x-if="!expanded">
                            <svg role="img" class="w-6 h-auto fill-white group-hover:fill-primary" width="1.392175"
                                 height="1.0546875">
                                <use xlink:href="{{ asset('icons/icons.svg#icon-menu') }}"/>
                            </svg>
                        </template>
                        <template x-if="expanded">
                            <svg role="img" class="w-6 h-auto fill-white group-hover:fill-primary" width="21.21"
                                 height="21.22">
                                <use xlink:href="{{ asset('icons/icons.svg#icon-close') }}"/>
                            </svg>
                        </template>
                    </div>
                    <span class="ml-6 sr-only">Expand</span>
                </button>
            </li>
        </ul>
        <ul class="flex flex-col gap-7">
            <li>
                <x-nav-link :active="request()->routeIs('dashboard')" icon="icon-dashboard" width="22.73" height="20.81" name="Dashboard"
                            href="{{ route('dashboard') }}"/>
            </li>
            <li>
                <x-nav-link :active="request()->routeIs('contacts.index')" icon="icon-contacts" width="22.68" height="15.04" name="Contacts"
                            href="{{ route('contacts.index') }}"/>
            </li>
            <li>
                <x-nav-link :active="request()->routeIs('projects.index')" icon="icon-projects" width="18" height="22.69" name="Projects"
                            href="{{ route('projects.index') }}"/>
            </li>
            <li>
                <x-nav-link :active="request()->routeIs('events.index')" class="fill-none stroke-2 stroke-white" icon="icon-events" width="21.5" height="21"
                            name="Epreuves" href="{{ route('events.index') }}"/>
            </li>
        </ul>
        <div>
            <x-nav-link :active="request()->routeIs('profile.edit')" icon="icon-profile" width="22.7" height="18.9" name="Profile"
                        href="{{ route('profile.edit') }}"/>
        </div>
        <div>
            <x-nav-link :active="false" icon="icon-log-out" width="21.94" height="22.69" name="Deconnexion"
                        href="{{ route('logout') }}"/>
        </div>
    </div>
</nav>
