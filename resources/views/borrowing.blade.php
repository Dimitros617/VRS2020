<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nová vypůjčka') }}
        </h2>
    </x-slot>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">
            <div class="list-group">
            @foreach($kategories as $kategory)


{{--                    <div class="col-sm-6">{{$kategory['nazev']}}</div>--}}
                    <a href="{{$kategory['nazev']}}" class="list-group-item list-group-item-action">{{$kategory['nazev']}}</a>
    <br>
                    @php(url()->current())
            @endforeach
            </div>
        </div>
    </div>


</x-app-layout>


