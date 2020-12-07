@section('title',$user[0] -> userSurname.' '. $user[0] -> userName)
<x-app-layout>

    <x-slot name="header"></x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">
            <div class="display-4">
            {{$user[0] -> userSurname}} {{$user[0] -> userName}}
            </div>
            <div class="">
                <p>Telefon: {{$user[0] -> userPhone}}</p>
                <p>E-mail: {{$user[0] -> userEmail}} </p>
            </div>
            <div>
                <label>Role uživatele: </label>
                <select name="selectPermition">
                    @foreach($permitions as $permition)

                            <option value="{{ $permition -> permitionId }}" @if($permition -> permitionId == $user[0] -> permitionId) selected @endif>{{ $permition -> permitionName }}</option>

                    @endforeach
                </select>
            </div>


        </div>
    </div>
</x-app-layout>
