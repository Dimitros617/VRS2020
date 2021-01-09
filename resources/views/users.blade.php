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
                        <div class="display-4 p-4 text-vrs-cyan"> Seznam uživatelů:</div>
                            <div class="search">
                                <div class="card card-sm">
                                    <div class="card-body row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <i class="fas fa-search h4 text-body"></i>
                                        </div>

                                        <div class="col">
                                            <input class="form-control-borderless" id="search" type="search" placeholder="Zadejte hledaný výraz">
                                        </div>

                                        <div class="col-auto">
                                            <div class="spinner-border text-dark" id="spinner" role="status" hidden></div>
                                            <button class="btn btn-lg btn-success" type="submit" onclick="userFind(this)">Najít</button>
                                            <button class="btn btn-lg btn-primary " data-sort="none" sort="desc" onclick="userSort(this)">&#8681;</button>
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
                                <p>E-mail: {{$user -> userEmail}} </p>
                            </div>

                            <button type="submit button" class="btn btn-success w-200p ">Poslat zprávu</button>
                            <a href="{{url()->current().'/'.$user -> userId}}">
                                <button type="submit button" class="btn btn-warning w-200p ">Upravit uživatele</button>
                            </a>
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
