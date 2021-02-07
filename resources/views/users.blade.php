@section('title',"Seznam uživatelů")
@section('css', URL::asset('css/user.css'))
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seznam uživatelů') }}
        </h2>
    </x-slot>
    <script src="/js/userGets.js"></script>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container p-6 ">

            @if(sizeof($users) != 0)
                <div class="list-group pt-4 pb-4">

                    <div class="hlavicka">
                        <div class="pageTitleSearch">Seznam uživatelů</div>
                        <div class="search">
                            <div class="bg-gray-100 rounded-3 modal-open">
                                <div class="card-body row no-gutters align-items-center h-4rem">

                                    <div class="col">
                                        <input class="form-control-borderless mt--1" id="search" type="search" placeholder="Zadejte hledaný výraz">

                                    </div>

                                    <div class="col-auto">
                                        <div class="spinner-border text-vrs-yellow searchSpinner mt--1" id="spinner" role="status" hidden></div>
                                    </div>


                                    <div class="col-auto searchButtonDiv">

                                        <button class="btn btn-lg btn-success searchButton" type="submit" onclick="userFind(this)">Najít</button>
                                        <button class="btn btn-lg btn-primary searchButton" data-sort="none" sort="desc" onclick="userSort(this)">&#8681;</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="userList">
                    @foreach($users as $user)
                        <div class="items-blocky userElement" userID="{{$user->userId}}">
                            <div class="nameDiv">
                                <div class="vrs-h2 text-vrs-cyan">
                                    {{$user -> userSurname}}
                                    {{$user -> userName}}
                                </div>
                                <div class="nick">
                                    {{$user -> userNick}}
                                </div>
                            </div>

                            <div class="vrs-h3 text-vrs-yellow">
                                {{$user -> permitionName}}
                            </div>

                            <div class="vrs-h4 text-vrs-cyan">
                                @if(Auth::permition()->new_user == 1 || Auth::permition()->return_verification == 1)
                                    {{$user -> userEmail}}
                                @endif
                            </div>

                            <div class="buttonsDiv">
                            @if(($user->userId != Auth::user()->id))
                                    <a class="p-0 buttonsDivItem">
                            <button class="btn btn-primary w-200p buttonsDivItem" onclick="prefixNewMessage('{{$user -> userNick}}') ">Poslat zprávu</button>
                                    </a>
                            @endif
                            @if(Auth::permition()->return_verification == 1 || Auth::permition()->possibility_renting == 1 || Auth::permition()->edit_item == 1)
                                    <a href="{{url()->current().'/'.$user -> userId.'/loans'}}" class="p-0 buttonsDivItem">
                                        <button class="btn btn-warning w-200p buttonsDivItem">Závazky uživatele</button>
                                    </a>
                            @endif
                            @if(Auth::permition()->new_user == 1)
                                <a href="{{url()->current().'/'.$user -> userId}}" class="p-0 buttonsDivItem">
                                    <button class="btn btn-success w-200p buttonsDivItem">Upravit uživatele</button>
                                </a>
                            @endif
                            </div>
                        </div>


                    @endforeach
                    </div>
                </div>
            @else
                <div class="display-4 pt-4 pb-4">Nebyli nalezeni žádní uživatelé. Pokud i přesto, že jste v systému, vidíte tuto hlášku, tak je něco hoooodně špatně. :-)</div>
            @endif

        </div>
    </div>
</x-app-layout>
