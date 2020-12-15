@section('title',$user[0] -> userSurname.' '. $user[0] -> userName)
<x-app-layout>

    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">
            @if(old('saveCheck'))
                @if(old('saveCheck') == 1)
                    <div id="autoHide" class="alert-success">
                        Změna proběhla úspěšně
                        @else
                            <div id="autoHide" class="alert-danger">
                                Ups... Došlo k chybě při ukládání
                                @endif
                                @endif
                            </div>

            <form action="{{'/users/' . $user[0]->userId . '/saveUserData'}}" method="POST" class="item">
                @csrf
                <div class="">
                    <input name="userId" value="{{$user[0]-> userId}}" hidden>
                    <div class="display-4">
                        <input class="" name="userName" value="{{$user[0] -> userName}}" required>
                        <input class="" name="userSurname" value="{{$user[0] -> userSurname}}" required>
                    </div>

                    <label for="name">Telefon: </label>
                    <input class="" name="userPhone" value="{{$user[0] -> userPhone}}" size=25 required>
                    <br>
                    <label for="name">E-mail: </label>
                    <input class="" type="email" name="userEmail" value="{{$user[0] -> userEmail}}" size=25 required>
                </div>

                <label>Role uživatele: </label>
                <select class="" name="selectPermition">
                    @foreach($permitions as $permition)

                            <option value="{{ $permition -> permitionId }}" @if($permition -> permitionId == $user[0] -> permitionId) selected @endif>{{ $permition -> permitionName }}</option>

                    @endforeach
                </select>
                <br>
                <input class="btn btn-primary" type="submit" value="Uložit změny">
            </form>


        </div>
    </div>
</x-app-layout>
