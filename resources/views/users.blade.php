@section('title',"Seznam uživatelů")
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seznam uživatelů') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">

            @if(sizeof($users) != 0)
                <div class="list-group pt-4 pb-4">

                    @foreach($users as $users)
                            <div class="display-4">
                                {{$users['surname']}}
                                {{$users['name']}}
                            </div>

                            <div class="">
                                <p>Telefon: {{$users['phone']}}, e-mail: {{$users['email']}} </p>
                            </div>
                    @endforeach
                </div>
            @else
                <div class="display-4 pt-4 pb-4">Nebyli nalezeni žádní uživatelé</div>
            @endif

        </div>
    </div>
</x-app-layout>
