@section('title',$item->name)

<x-app-layout>
    <x-slot name="header"></x-slot>

    <script src="/js/datePicker.js"></script>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">

            <div class="allLoans">

                <div class="h1"> Položka {{$item->name}} je v závazku s těmito uživately:</div>

                <div class="list-group">

                    @if(count($users) == 0)
                        <div class="nothing"> Tatuto položka není vypůjčená ani rezervovaná</div>
                    @endif

                    @foreach($users as $user)
                        <a href="/users/{{$user->id}}" class="list-group-item list-group-item-action">

                            <div
                                class="userName text-uppercase font-weight-bold ">{{$user->name}} {{$user->surname}}</div>

                            <div class="loanFrom"><label>OD: </label>{{$user->rent_from}}</div>
                            <div class="loanTo"><label>DO: </label>{{$user->rent_to}}</div>


                        </a>
                    @endforeach
                </div>

            </div>

        </div>
    </div>


</x-app-layout>


