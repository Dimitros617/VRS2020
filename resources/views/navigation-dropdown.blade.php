

<div id="messageModal" hidden onclick=" closeMessages(this)">

    <div class=" messageBackground bg-white overflow-hidden shadow-xl rounded max-w-6xl mx-auto sm:px-6 lg:px-8" id="allMessages">
        <div class="d-flex justify-content-between messagesHeaderBox">
            <div class="display-4 p-4 text-white"> Zprávy: </div>
            <div class="spinner-border  text-vrs-yellow"  style="width: 3rem; height: 3rem; margin: auto;" id="messageLoading" role="status"></div>
            <div class="newMessageBox"><button type="button" class="btn btn-light text-20px" onclick="newMessage()">Nová zpráva</button></div>
        </div>
        <div id="messagesBox"></div>
    </div>

    <div class=" messageBackground bg-white overflow-hidden shadow-xl rounded max-w-6xl mx-auto sm:px-6 lg:px-8" id="newMessages" hidden>
        <div class="d-flex justify-content-between messagesHeaderBox">
            <div class="display-4 p-4 text-white"> Nová zpráva: </div>
            <div class="spinner-border  text-vrs-yellow"  style="width: 3rem; height: 3rem; margin: auto;" id="sendMessageLoading" role="status" hidden></div>
            <div class="newMessageBox"><button type="button" class="btn btn-light text-20px" onclick="allMessage()">Moje zprávy</button></div>
        </div>
        <div id="messagesBox">
            <div class="autocomplete" >
                <div>
                <input id="userNameTo" type="text"  autocomplete="off" placeholder="Přezdívka příjemce:">
                </div>
                <textarea id="messageText" placeholder="Text zprávy pro příjemce, maximálně 3000 znaků."></textarea>
                <button type="button" class="btn btn-success float-end mt-3 " onclick="sendMessage(this)">Odeslat</button>
                <div id="httpRequestMessage" class="float-end mt-4 mr-3" hidden>Odesláno</div>
            </div>
        </div>
    </div>

</div>

<div id="notificationModal" hidden></div>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-lg p-3 mb-5">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- The Modal -->




<div class="notifDiv">
        <div class="flex justify-between flex-sm-row h-40 flex-column">
            <div class="flex">


                <!-- Logo -->
                <div class="w-100 mb-55px flex-shrink-0 flex items-center">
                    <a class="ml-20 headLogoMobile mt-4-5 mt-sm-5"  href="{{ route('dashboard') }}">
                        <x-jet-application-logo class="block h-9 w-auto"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                {{--                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">--}}
                {{--                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">--}}
                {{--                        {{ __('Hlavní strana') }}--}}
                {{--                    </x-jet-nav-link>--}}
                {{--                </div>--}}
            </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 headerMargin">
                <x-jet-dropdown align="right" width="48" >
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-lg border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <img class="h-8 w-8 rounded-full object-cover"
                                     src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                            </button>
                        @else
                            <button
                                class="text-vrs-yellow fw-bolder flex items-center text-lg font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div> {{ Auth::user()->nick}}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        {{--                        <div class="block px-4 py-2 text-xs text-gray-400">--}}
                        {{--                            {{ __('Možnosti') }}--}}
                        {{--                        </div>--}}

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Nastavení') }}
                        </x-jet-dropdown-link>

                        {{--                        Přidané položkdy do menu a pozor musí se upravit 2x i pro mobilní verzi níže--}}

                        <x-jet-dropdown-link href="/users">
                            {{ __('Seznam uživatelů') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="/loans">
                            {{ __('Moje výpůjčky') }}
                        </x-jet-dropdown-link>

                        @if(Auth::permition()->possibility_renting == 1)
                        <x-jet-dropdown-link href="/categories">
                            {{ __('Nová výpůjčka') }}
                        </x-jet-dropdown-link>
                        @endif

                        @if((Auth::permition()->return_verification == 1 || Auth::permition()->edit_item == 1) && Auth::permition()->possibility_renting != 1)
                            <x-jet-dropdown-link href="/categories">
                                {{ __('Kategorie, položky') }}
                            </x-jet-dropdown-link>
                        @endif

                        @if(Auth::permition()->return_verification == 1)
                            <x-jet-dropdown-link href="/all-loans">
                                {{ __('Všechny výpůjčky') }}
                            </x-jet-dropdown-link>
                        @endif

                        @if(Auth::permition()->edit_permitions == 1)
                            <x-jet-dropdown-link href="/permitions">
                                {{ __('Uživatelská oprávnění') }}
                            </x-jet-dropdown-link>
                        @endif


                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            {{--                            <div class="block px-4 py-2 text-xs text-gray-400">--}}
                            {{--                                {{ __('Manage Team') }}--}}
                            {{--                            </div>--}}

                        <!-- Team Settings -->
                            <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Nastavit roli') }}
                            </x-jet-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Vytvořit novou roli') }}
                                </x-jet-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Změnit roli') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team"/>
                            @endforeach

                            <div class="border-t border-gray-100"></div>
                    @endif

                    <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Odhlásit se') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </div>

            <!-- Hamburger -->


            <div class="mobileHeadMenu flex items-center sm:hidden mt-sm-70px " >
                <button @click="open = ! open"
                        class="ms-90 me-sm-0 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

    <!-- Notifications -->
    <div class="notification">
        <a onclick="showMessages(); achievementCount()">
            <img src="{{ URL::asset('img/mail.svg') }}" class="notificationSVG">
            <span class="badge badge-pill badge-danger notificationBadge" id="newMessageCount" onload="countNewMessages(this); setInterval(countNewMessages, 20000,this)" hidden> - </span>
            <div class="spinner-grow spinner-grow-sm text-danger notificationBadge" id="newMessageCountLoading" role="status"></div>
        </a>
    </div>
    </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Hlavní strana') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                         alt="{{ Auth::user()->name . " " . Auth::user()->surname }}"/>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name ." ".Auth::user()->surname }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                                           :active="request()->routeIs('profile.show')">
                        {{ __('Nastavení') }}
                </x-jet-responsive-nav-link>

                {{--                Přidané položkdy do menu a pozor musí se upravit 2x i pro mobilní verzi níže--}}

                <x-jet-responsive-nav-link href="/users">
                    {{ __('Seznam uživatelů') }}
                </x-jet-responsive-nav-link>

                <x-jet-responsive-nav-link href="/loans">
                    {{ __('Moje výpůjčky') }}
                </x-jet-responsive-nav-link>

                @if(Auth::permition()->possibility_renting == 1)
                <x-jet-responsive-nav-link href="/categories">
                    {{ __('Nová výpůjčka') }}
                </x-jet-responsive-nav-link>
                @endif

                @if((Auth::permition()->return_verification == 1 || Auth::permition()->edit_item == 1) && Auth::permition()->possibility_renting != 1)
                <x-jet-responsive-nav-link href="/categories">
                    {{ __('Kategorie, položky') }}
                </x-jet-responsive-nav-link>
                @endif

                @if(Auth::permition()->return_verification == 1)
                    <x-jet-responsive-nav-link href="/all-loans">
                        {{ __('Všechny výpůjčky') }}
                    </x-jet-responsive-nav-link>
                @endif

                @if(Auth::permition()->edit_permitions == 1)
                    <x-jet-responsive-nav-link href="/permitions">
                        {{ __('Uživatelská oprávnění') }}
                    </x-jet-responsive-nav-link>
                @endif

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                                               :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

            <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Odhlásit se') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    {{--                    <div class="block px-4 py-2 text-xs text-gray-400">--}}
                    {{--                        {{ __('Manage Team') }}--}}
                    {{--                    </div>--}}

                <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                                               :active="request()->routeIs('teams.show')">
                        {{ __('Nastavení role') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('teams.create') }}"
                                               :active="request()->routeIs('teams.create')">
                        {{ __('Vytvořit novou roli') }}
                    </x-jet-responsive-nav-link>

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Změnit roli') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link"/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
