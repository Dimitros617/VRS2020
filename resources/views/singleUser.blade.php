@section('title',$user[0] -> userSurname.' '. $user[0] -> userName)
@section('css', URL::asset('css/user-setting.css'))
<x-app-layout>

    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>
    <script src="/js/user-save.js"></script>

{{--    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">--}}

{{--        <div class="container p-6">--}}
{{--            @if(old('saveCheck'))--}}
{{--                @if(old('saveCheck') == 1)--}}
{{--                    <div id="autoHide" class="alert-success">--}}
{{--                        Změna proběhla úspěšně--}}
{{--                        @else--}}
{{--                            <div id="autoHide" class="alert-danger">--}}
{{--                                Ups... Došlo k chybě při ukládání--}}
{{--                                @endif--}}
{{--                                @endif--}}
{{--                            </div>--}}

{{--            <form  id="userDataForm" onsubmit="saveUserData(this,'{{$user[0]->userId}}'); return false;">--}}
{{--                @csrf--}}

{{--                    <input name="userId" value="{{$user[0]-> userId}}" hidden> <!-- toto neupravuješ :-) nevidíš, nehrab :-D -->--}}

{{--                <div class="userData">--}}
{{--                    <input class="name" name="userName" value="{{$user[0] -> userName}}" oninput="document.getElementById('userDataForm').getElementsByClassName('submit')[0].removeAttribute('hidden')" required>--}}
{{--                    <input class="name" name="userSurname" value="{{$user[0] -> userSurname}}" oninput="document.getElementById('userDataForm').getElementsByClassName('submit')[0].removeAttribute('hidden')" required>--}}
{{--                    <input class="nick" name="userNick" value="{{$user[0] -> userNick}}" oninput="document.getElementById('userDataForm').getElementsByClassName('submit')[0].removeAttribute('hidden')" required>--}}
{{--                </div>--}}

{{--                    <label for="userPhone">Telefon: </label>--}}
{{--                    <input class="userPhone" name="userPhone" value="{{$user[0] -> userPhone}}" size=25 oninput="document.getElementById('userDataForm').getElementsByClassName('submit')[0].removeAttribute('hidden')" required>--}}
{{--                    <label for="userEmail">E-mail: </label>--}}
{{--                    <input class="" type="email" name="userEmail" value="{{$user[0] -> userEmail}}" size=25 oninput="document.getElementById('userDataForm').getElementsByClassName('submit')[0].removeAttribute('hidden')" required>--}}


{{--                    <label for="selectPermition">Role uživatele: </label>--}}
{{--                    <select class="" name="selectPermition" oninput="document.getElementById('userDataForm').getElementsByClassName('submit')[0].removeAttribute('hidden')">--}}
{{--                    @foreach($permitions as $permition)--}}

{{--                            <option value="{{ $permition -> permitionId }}" @if($permition -> permitionId == $user[0] -> permitionId) selected @endif>{{ $permition -> permitionName }}</option>--}}

{{--                    @endforeach--}}
{{--                    </select>--}}

{{--                <button type="submit button" class="submit btn btn-primary w-200p float-end p-2 me-4-5 w-10rem text-white" hidden>--}}
{{--                    <div id="buttonText">Uložit změny</div>--}}
{{--                    <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>--}}
{{--                </button>--}}
{{--            </form>--}}
{{--                            <button type="submit button" class="btn btn-success w-200p " onclick="prefixNewMessage('{{$user[0] -> userNick}}') ">Poslat zprávu</button>--}}


{{--    </div>--}}

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h1 class="text-lg font-medium text-vrs-yellow h3">Informace o uživateli {{$user[0] -> userName.' '. $user[0] -> userSurname}}</h1>

                <p class="mt-1 text-md text-white">
                    Pozor, zde upravujete osobní informace jiného uživatele!
                </p>
            </div>
        </div>


        <div class="mt-5 md:mt-0 md:col-span-2">
            <form id="userDataForm" onsubmit="saveUserData(this,'{{$user[0]->userId}}'); return false;" >
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Profile Photo -->

                            @csrf

                            <input name="userId" value="{{$user[0]-> userId}}" hidden>

                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="name">
                                    Jméno
                                </label>

                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" type="text" name="userName" value="{{$user[0] -> userName}}" required  autocomplete="name">


                            </div>

                            <!-- Příjmení -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="surname">
                                    Příjmení
                                </label>

                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="surname" type="text" name="userSurname" value="{{$user[0] -> userSurname}}" required autocomplete="surname">


                            </div>

                            <!-- Přezdívka -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="nick">
                                    Přezdívka
                                </label>

                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="nick" type="text" name="userNick" value="{{$user[0] -> userNick}}" required autocomplete="nickname">


                            </div>

                            <!-- Telefon -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="phone">
                                    Telefon
                                </label>

                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="phone" type="text" name="userPhone" value="{{$user[0] -> userPhone}}" size=25 required autocomplete="phone">


                            </div>

                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="email">
                                    E-mail
                                </label>

                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="email" type="email" name="userEmail" value="{{$user[0] -> userEmail}}" required autocomplete="mail">


                            </div>
                            <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700"  for="selectPermition">Role uživatele: </label>
                            <select class="form-select rounded-md shadow-sm mt-1 block w-full" name="selectPermition" oninput="document.getElementById('userDataForm').getElementsByClassName('submit')[0].removeAttribute('hidden')">
                            @foreach($permitions as $permition)

                                    <option class="" value="{{ $permition -> permitionId }}" @if($permition -> permitionId == $user[0] -> permitionId) selected @endif>{{ $permition -> permitionName }}</option>

                            @endforeach
                            </select>
                            </div>


                        </div>
                    </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit button" class="btn btn-danger w-200p float-end p-2 w-10rem text-white px-4 py-2" >
                                            <div id="buttonText">Uložit změny</div>
                                            <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

</x-app-layout>
