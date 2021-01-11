@section('title',"Seznam uživatelů")
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seznam uživatelů') }}
        </h2>
    </x-slot>
    <script src="/js/userGets.js"></script>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">

            @if(sizeof($users) != 0)
                <div class="list-group pt-4 pb-4">

                    <div class="hlavicka">
                        <div class="pageTitleSearch"> Seznam uživatelů:</div>
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
                        <div class="list-group-item list-group-item-action userElement" userID="{{$user->userId}}">
                            <div class="display-4">
                                {{$user -> userSurname}}
                                {{$user -> userName}} -
                                {{$user -> userNick}}
                            </div>
                            <div>
                                {{$user -> permitionName}}
                            </div>

                            <div class="">
                                @if(Auth::permition()->new_user == 1)
                                    <p>E-mail: {{$user -> userEmail}} </p>
                                @endif
                            </div>

                            <button class="btn btn-primary w-200p " onclick="prefixNewMessage('{{$user -> userNick}}') ">Poslat zprávu</button>
                            @if(Auth::permition()->possibility_renting == 1)
                                <a href="{{url()->current().'/'.$user -> userId.'/loans'}}">
                                    <button class="btn btn-warning w-200p">Závazky uživatele</button>
                                </a>
                                @if(Auth::permition()->new_user == 1)
                                    <a href="{{url()->current().'/'.$user -> userId}}">
                                        <button class="btn btn-success w-200p ">Upravit uživatele</button>
                                    </a>
                                @endif
                            @endif
                        </div>


                    @endforeach
                    </div>
                </div>
            @else
                <div class="display-4 pt-4 pb-4">Nebyli nalezeni žádní uživatelé</div>
            @endif

        </div>
    </div>
</x-app-layout>
