<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nová vypůjčka') }}
        </h2>
    </x-slot>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">

            <h1>{{$category['name']}}</h1>
            <br>
            <p>{{$category['description']}}</p>

        </div>
    </div>


</x-app-layout>


