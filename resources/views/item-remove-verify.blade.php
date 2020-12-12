@section('title',$item->name)
@section('css', URL::asset('css/item-remove-verify.css'))

<x-app-layout>
    <x-slot name="header"></x-slot>

    <script src="/js/datePicker.js"></script>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">

            <form action="{{'/item/' . $item->id . '/removeItemHard'}}" method="POST" class="removeVerify text-center">
                @csrf
                <div class="h1"> Opravdu ?</div>
                <div class=""> k dané položce jsme našly probíhající rezervace. Přejete si smazat položku včetně všech probíhajících rezervací ?</div>
                <input type="text" class="d-none" name="itemId" value="{{$item->id}}">
                <br>
                <input class="btn btn-danger" type="submit" value="Smazat položku {{$item->name}} a všechny závazky">
            </form>

            <hr>

            <div class="allLoans">

                <div class="h1"> Položka {{$item->name}} je v závazku s těmito uživately:</div>

                <div class="list-group">
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


